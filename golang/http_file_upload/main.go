package main

import (
	"fmt"
	"net/http"
	"time"
	"os"
	"io"
	"encoding/json"
	"runtime"
	"net/url"
	"mime/multipart"
	"mime"
	"bytes"
	"errors"
)

func readUntilFile(r *http.Request, fileFormName string) (formValues url.Values, file_part *multipart.Part, err error) {
	var values = make(url.Values)
	v := r.Header.Get("Content-Type")
	if v == "" {
		return nil, nil, http.ErrNotMultipart
	}
	d, params, err := mime.ParseMediaType(v)
	if err != nil || d != "multipart/form-data" {
		return nil, nil, http.ErrNotMultipart
	}
	boundary, ok := params["boundary"]
	if !ok {
		return nil, nil, http.ErrMissingBoundary
	}
	var mr = multipart.NewReader(r.Body, boundary)

	//10M
	var maxMemForNotFile = int64(10 << 20)

	// Reserve an additional 10 MB for non-file parts.
	maxValueBytes := maxMemForNotFile + int64(10<<20)
	var mp *multipart.Part
	for {
		p, err := mr.NextPart()
		if err == io.EOF {
			break
		}
		if err != nil {
			return nil, nil, err
		}
		name := p.FormName()
		if name == "" {
			continue
		}
		filename := p.FileName()

		var b bytes.Buffer

		if filename == "" {
			// value, store as string in memory
			n, err := io.CopyN(&b, p, maxValueBytes+1)
			if err != nil && err != io.EOF {
				return nil, nil, err
			}
			maxValueBytes -= n
			if maxValueBytes < 0 {
				return nil, nil, multipart.ErrMessageTooLarge
			}
			values.Set(name, b.String())
			continue
		}
		if name != fileFormName {
			return nil, nil, errors.New("please upload file name key with '" + fileFormName + "'")
		}
		mp = p
		break
	}
	return values, mp, nil
}

func storeFile(filePart *multipart.Part, path string) (size int64, err error) {
	store, err := os.OpenFile(path+filePart.FileName(), os.O_WRONLY|os.O_CREATE, 0666)
	defer store.Close()
	return io.Copy(store, io.MultiReader(filePart))
}

func uploadHandler(w http.ResponseWriter, r *http.Request) {
	var info = make(map[string]interface{})
	info["start_time"] = time.Now().Unix()
	info["method"] = r.Method
	if r.Method == "POST" {
		info["form.name"] = r.PostFormValue("name")
		info["form.parsed_time"] = time.Now().Unix()
		file, handler, err := r.FormFile("file")
		if err != nil {
			info["error"] = err.Error()
		} else {
			defer file.Close()
			store, err := os.OpenFile("./upload_default/"+handler.Filename, os.O_WRONLY|os.O_CREATE, 0666)
			if err != nil {
				info["error"] = err.Error()
			} else {
				defer store.Close()
				io.Copy(store, file)
			}
		}
	}
	info["end_time"] = time.Now().Unix()
	data, _ := json.Marshal(info);
	w.Header().Set("Content-Type", "application/json")
	fmt.Println("GO Routine Nums:", runtime.NumGoroutine())
	fmt.Fprintf(w, "%s", string(data))
}

func uploadOpz(w http.ResponseWriter, r *http.Request) {
	var info = make(map[string]interface{})
	info["start_time"] = time.Now().Unix()
	info["method"] = r.Method
	if r.Method == "POST" {
		values, filePart, err := readUntilFile(r, "file")
		if err != nil {
			info["error"] = err.Error()
		} else {
			info["form.name"] = values.Get("name")
			info["form.get_name_time"] = time.Now().Unix()
			if values.Get("name") != "xxx" {
				info["error"] = "name shoud be 'xxx'"
			} else {
				_, err := storeFile(filePart, "./upload_default/")
				if err != nil {
					info["error"] = err.Error()
				} else {
					info["form.stored_file_name"] = time.Now().Unix()
				}
			}
		}
	}
	info["end_time"] = time.Now().Unix()
	data, _ := json.Marshal(info);
	w.Header().Set("Content-Type", "application/json")
	fmt.Println("GO Routine Nums:", runtime.NumGoroutine())
	fmt.Fprintf(w, "%s", string(data))
}

func main() {
	//http.HandleFunc("/upload", uploadHandler)
	//http.ListenAndServe(":8080", nil)
	var mux = http.NewServeMux()
	mux.HandleFunc("/", uploadHandler)
	mux.HandleFunc("/opz", uploadOpz)
	//http.ListenAndServe(":8080", mux)
	//var server = &http.Server{Addr: ":8080", Handler: mux}
	var server = new(http.Server)
	server.Addr = ":8080"
	server.Handler = mux
	fmt.Println("Ready to run http server.")
	server.ListenAndServe()
}

package main

import (
	"fmt"
	"net/http"
	"time"
	"os"
	"io"
	"encoding/json"
)

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
	fmt.Fprintf(w, "%s", string(data))
}

func main() {
	//http.HandleFunc("/upload", uploadHandler)
	//http.ListenAndServe(":8080", nil)
	var mux = http.NewServeMux()
	mux.HandleFunc("/", uploadHandler)
	//http.ListenAndServe(":8080", mux)
	//var server = &http.Server{Addr: ":8080", Handler: mux}
	var server = new(http.Server)
	server.Addr = ":8080"
	server.Handler = mux
	fmt.Println("Ready to run http server.")
	server.ListenAndServe()
}

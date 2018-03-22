package main

import "fmt"
import "net/http"
import "time"
import "os"
import "io"

func uploadHandler(w http.ResponseWriter, r *http.Request) {
	fmt.Println(time.Now().Unix())
	fmt.Println("method:", r.Method)
	if r.Method == "POST" {
		name := r.PostFormValue("name")
		fmt.Println("name: ", name)
		fmt.Println(time.Now().Unix())
		file, handler, err := r.FormFile("file")
		if err != nil {
			fmt.Println(err)
			return
		}
		defer file.Close()
		store, err := os.OpenFile("./upload_default/"+handler.Filename, os.O_WRONLY|os.O_CREATE, 0666)
		if err != nil {
			fmt.Println(err)
			return
		}
		defer store.Close()
		io.Copy(store, file)
		fmt.Println(time.Now().Unix())
		fmt.Println("Copy Complete!")
	}
	fmt.Fprintf(w, "Receive %s", r.Method)
}

func main() {
	//http.HandleFunc("/upload", uploadHandler)
	//http.ListenAndServe(":8080", nil)
	var mux = http.NewServeMux()
	mux.HandleFunc("/upload", uploadHandler)
	//http.ListenAndServe(":8080", mux)
	//var server = &http.Server{Addr: ":8080", Handler: mux}
	var server = new(http.Server)
	server.Addr = ":8080"
	server.Handler = mux
	server.ListenAndServe()
}

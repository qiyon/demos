package main

import (
	"fmt"
	"net/http"
	"golang.org/x/net/websocket"
)

func main() {
	http.Handle("/", http.FileServer(http.Dir("./public")))
	http.Handle("/socket", websocket.Handler(func(ws *websocket.Conn) {
		websocket.Message.Send(ws, "You connect")
		for {
			var reply string
			websocket.Message.Receive(ws, &reply)
			fmt.Println("Receive: " + reply)
			send_msg := "ws Received " + reply
			websocket.Message.Send(ws, send_msg)
		}
	}))
	fmt.Println("Server Running...")
	http.ListenAndServe(":18300", nil)
}

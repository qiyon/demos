package main

import (
	"app"
	"log"
)

func main() {
	var a = new(app.App)
	a.Hello = "Hello Word"
	log.Print(a.Hello)
}

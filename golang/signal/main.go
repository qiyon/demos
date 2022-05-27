package main

import (
	"fmt"
	"os"
	"os/signal"
	"syscall"
)

func main() {
	sigs := make(chan os.Signal, 1)
	done := make(chan bool, 1)

	//register signals input chan [sigs]
	signal.Notify(sigs, syscall.SIGINT, syscall.SIGTERM)

	go func() {
		sig := <-sigs //wait signal
		fmt.Print("Receive signal: ")
		fmt.Println(sig)
		done <- true //complete solve
	}()

	fmt.Println("awaiting signal")
	<-done //wait solve
	fmt.Println("exiting")
}

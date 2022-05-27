package main

import (
	"fmt"
	"strings"
	"sync"
	"time"

	"github.com/beanstalkd/go-beanstalk"
)

func main() {
	go func() {
		fmt.Println("listen beanstalk")
		conn, err := beanstalk.Dial("tcp", "127.0.0.1:11300")
		if nil != err {
			fmt.Printf("beanstalk dial err %v\n", err)
			return
		}
		defer conn.Close()

		conn.Tube.Name = "TubeDemo"
		conn.TubeSet.Name["TubeDemo"] = true

		for {
			id, body, err := conn.Reserve(3 * time.Second)
			if nil != err {
				fmt.Printf("%v\n", err)
				if !strings.Contains(err.Error(), "timeout") {
					fmt.Printf("beanstalk reserve err %v\n", err)
				}
				continue
			}

			// do something ...
			fmt.Printf("beanstalk data: %s\n", string(body))

			if err := conn.Delete(id); nil != err {
				fmt.Printf("beanstalk delete err %v\n", err)
			}
		}
	}()

	wg := sync.WaitGroup{}
	wg.Add(1)
	wg.Wait()
}

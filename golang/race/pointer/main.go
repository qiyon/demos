package main

import (
	"fmt"
	"sync"
	"time"
)

type Wrapper struct {
	IntraPtr *Intra
	m        sync.Mutex
}

func (w *Wrapper) Reset() {
	//w.m.Lock()
	//defer w.m.Unlock()
	w.IntraPtr = &Intra{Val: "2"}
}

type Intra struct {
	Val string
}

func (s *Intra) Run() {
	for i := 0; i < 10; i++ {
		time.Sleep(100 * time.Millisecond)
		fmt.Println(s.Val)
	}
}

func main() {
	w := &Wrapper{
		IntraPtr: &Intra{Val: "1"},
	}

	go func() {
		//w.m.Lock()
		//defer w.m.Unlock()
		w.IntraPtr.Run()
	}()

	time.Sleep(300 * time.Millisecond)
	w.Reset()

	time.Sleep(1 * time.Second)
}

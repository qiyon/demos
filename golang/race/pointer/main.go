package main

import (
	"fmt"
	"sync"
	"time"
)

type ServiceDemo struct {
	Component *ComponentDemo
	m         sync.Mutex
}

func (s *ServiceDemo) Init() {
	s.Component = &ComponentDemo{Val: "1"}
}

func (s *ServiceDemo) Fresh() {
	s.m.Lock()
	defer s.m.Unlock()
	s.Component = &ComponentDemo{Val: "2"}
}

func (s *ServiceDemo) Run() {
	s.Component.Run()
}

func (s *ServiceDemo) SafeGetComponent() *ComponentDemo {
	s.m.Lock()
	defer s.m.Unlock()
	return s.Component
}

func (s *ServiceDemo) SafeRun() {
	p := s.SafeGetComponent()
	p.Run()
}

type ComponentDemo struct {
	Val string
}

func (c *ComponentDemo) Run() {
	for i := 0; i < 10; i++ {
		time.Sleep(50 * time.Millisecond)
		fmt.Println(c.Val)
	}
}

func main() {
	svc := &ServiceDemo{}
	svc.Init()
	go func() {
		time.Sleep(300 * time.Millisecond)
		fmt.Printf("Service Component Fresh...\n")
		svc.Fresh()
	}()

	for i := 0; i <= 3; i++ {
		fmt.Printf("Svc Run In Loop: %d\n", i)

		svc.Run()
		//svc.SafeRun()
	}
}

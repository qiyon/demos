package main

import (
	"encoding/json"
	"fmt"

	"goprotodemo/proto/package1"
	"goprotodemo/proto/package2"
)

func main() {
	msg := package2.Req{
		PackageOneReq: &package1.Req{},
	}
	j, _ := json.Marshal(msg)
	fmt.Println(string(j))
}

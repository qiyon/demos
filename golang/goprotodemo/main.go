package main

import (
	"encoding/json"
	"fmt"

	"goprotodemo/proto/package1"
	"goprotodemo/proto/package2"
)

func main() {
	msg := &package2.Req{
		No:   "no",
		Name: "name",
		PackageOneReq: &package1.Req{
			StrField: "str",
			IntField: 1,
		},
	}
	j, _ := json.Marshal(msg)
	fmt.Println(string(j))
}

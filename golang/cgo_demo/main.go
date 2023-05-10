package main

/*
#include "demo.h"
*/
import "C"
import (
	"fmt"
	"unsafe"
)

func main() {
	var goA, goB int = 2, 5
	resFromC := C.demoMultiply(C.int(goA), C.int(goB))
	fmt.Printf("Print result in GoLang: %d\n", int(resFromC))

	fmt.Println()

	str := C.CString("[String From GoLang.]")
	defer C.free(unsafe.Pointer(str))
	C.demoStrPrint(str)
}

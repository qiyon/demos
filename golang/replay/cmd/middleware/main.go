/*
How middleware works:

                   Original request      +--------------+
+-------------+----------STDIN---------->+              |
|  Gor input  |                          |  Middleware  |
+-------------+----------STDIN---------->+              |
                   Original response     +------+---+---+
                                                |   ^
+-------------+    Modified request             v   |
| Gor output  +<---------STDOUT-----------------+   |
+-----+-------+                                     |
      |                                             |
      |            Replayed response                |
      +------------------STDIN----------------->----+
*/

package main

import (
	"bufio"
	"bytes"
	"encoding/hex"
	"fmt"
	"os"

	"github.com/buger/goreplay/proto"
)

func main() {
	scanner := bufio.NewScanner(os.Stdin)

	for scanner.Scan() {
		encoded := scanner.Bytes()
		buf := make([]byte, len(encoded)/2)
		hex.Decode(buf, encoded)

		process(buf)
	}
}

func process(buf []byte) {
	// First byte indicate payload type, possible values:
	//  1 - Request
	//  2 - Response
	//  3 - ReplayedResponse
	payloadType := buf[0]
	headerSize := bytes.IndexByte(buf, '\n') + 1
	payload := buf[headerSize:]

	switch payloadType {
	case '1':
		// Request
		reqPath := proto.Path(payload)
		reqBody := proto.Body(payload)
		Debug("Received Request:", string(reqPath), string(reqBody))

		var replay bool

		if bytes.Equal(reqPath, []byte("/xxx")) {
			replay = true
			payload = proto.DeleteHeader(payload, []byte("Host"))
			payload = proto.SetHeader(payload, []byte("Host"), []byte("xxx.custom.host"))
		}

		// Emitting data back
		if replay {
			buf = append(buf[:headerSize], payload...)
			os.Stdout.Write(encode(buf))
		} else {
			Debug("Drop Request:", string(reqPath))
		}
	case '2':
		// Original response
		originResp := proto.Body(payload)
		Debug("Original Response body: ", string(originResp))
	case '3':
		// Replayed response
		replayResp := proto.Body(payload)
		Debug("Replayed Response body: ", string(replayResp))
	}
}

func encode(buf []byte) []byte {
	dst := make([]byte, len(buf)*2+1)
	hex.Encode(dst, buf)
	dst[len(dst)-1] = '\n'

	return dst
}

func Debug(args ...interface{}) {
	if os.Getenv("GOR_TEST") == "" { // if we are not testing
		fmt.Fprintln(os.Stderr, args...)
	}
}

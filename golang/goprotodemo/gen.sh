protoc -I . ./proto/package1/*.proto  --go_out=plugins=grpc:.
protoc -I . ./proto/package2/*.proto  --go_out=plugins=grpc:.

# Http Upload

## start

```
touch file.txt
go run main.go
## An other terminal
curl -X POST -F "name=xxx" -F "file=@file.txt" 127.0.0.1:8080
```

## Used Time Test

Create a new big file

```
## Mac OS
mkfile 512m file.txt

## Linux
dd if=/dev/zero of=file.txt bs=1m count=512
```

## Default Http Solve

curl rate limit

```
curl -X POST -F "name=xxx" -F "file=@file.txt" --limit-rate 50m 127.0.0.1:8080
```

Golang http, default (`PostFormValue()`) resolve the html multipart/form-data input and file info, after get all data from client

## Optimized parse multipart form

```
//store file success
curl -X POST -F "name=xxx" -F "file=@file.txt" --limit-rate 50m "http://127.0.0.1:8080/opz"

//return fail immediately
curl -X POST -F "name=xxx11" -F "file=@file.txt" --limit-rate 50m "http://127.0.0.1:8080/opz"
```

Will parse form info before the file, means that can do some auth check before receive file data

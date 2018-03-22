# Http Upload

## start

```
touch file.txt
go run main.go
## An other terminal
curl -X POST -F "name=xxx" -F "file=@file.txt" 127.0.0.1:8080
```

## Timeout Test

Create a new big file

```
## Mac OS
mkfile 512m file.txt
```

curl rate limit

```
curl -X POST -F "name=xxx" -F "file=@file.txt" --limit-rate 50m 127.0.0.1:8080
```

## conclusion

Golang http, default (`PostFormValue()`) resolve the html multipart/form-data input and file info, after get all data from client


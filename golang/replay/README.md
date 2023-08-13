# GoReplay Demo

## Middleware

```shell
go build -o replay_middle cmd/middleware/main.go

gor --input-raw :8080 --middleware "./replay_middle" --output-http "http://127.0.0.1:8081"
```

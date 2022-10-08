# fpm-ng

php web server app container image, use nginx with php-fpm.

## build

build image: 

```
docker build -t qiyon/fpm-ng:7.4 .
```

## run

### prod

docker production deploy demo:

```
docker run -d --name fpm74 qiyon/fpm-ng:7.4
```

### dev

docker develop demo:

```
docker run -d --name fpm74 -p 22080:80 -v /your/project/dir:/var/www/fpm-ng qiyon/fpm-ng:7.4
```

host nginx entry server config demo:

```
server {
    listen              80;
    server_name         appname-dev.custom.host;

    location / {
        proxy_http_version 1.1;
        proxy_set_header   Connection "";
        proxy_redirect     off;
        proxy_set_header   Host             $host;
        proxy_set_header   X-Real-IP        $remote_addr;
        proxy_set_header   X-Forwarded-For  $proxy_add_x_forwarded_for;
        
        proxy_pass         http://127.0.0.1:22080;
    }
}
```

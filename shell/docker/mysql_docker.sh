docker run --name mysql --network host --restart=always -e MYSQL_ROOT_PASSWORD=123456 -v /path/to/mysql/vdisk:/var/lib/mysql -d mysql:5.7
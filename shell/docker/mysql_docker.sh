docker run --name mysql --restart=always -e MYSQL_ROOT_PASSWORD=123456 -v /path/to/mysql/vdisk:/var/lib/mysql -p 3306:3306 -d mysql:5.7

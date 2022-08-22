FROM ubuntu:20.04

# apt
RUN sed -i 's|/archive.ubuntu.com/|/mirrors.ustc.edu.cn/|g' /etc/apt/sources.list
RUN sed -i 's|/security.ubuntu.com/|/mirrors.ustc.edu.cn/|g' /etc/apt/sources.list
RUN apt-get update

# install
RUN apt-get install -y vim curl wget tzdata nginx php-fpm php-curl php-mysql php-redis

# timezone
RUN ln -fs /usr/share/zoneinfo/Asia/Shanghai /etc/localtime

# configs
ADD ./dockerfiles/nginx/nginx.conf /etc/nginx/nginx.conf
ADD ./dockerfiles/nginx/www.conf /etc/nginx/vhost/www.conf
ADD ./dockerfiles/php/fpm-www.conf /etc/php/7.4/fpm/pool.d/www.conf

# project files
ADD ./ /var/www/fpm-ng

# start script
ADD ./dockerfiles/*.sh /bin/
RUN chmod +x /bin/*.sh
CMD ["start.sh"]


FROM ubuntu:20.04

# apt
RUN sed -i 's|/archive.ubuntu.com/|/mirrors.ustc.edu.cn/|g' /etc/apt/sources.list
RUN sed -i 's|/security.ubuntu.com/|/mirrors.ustc.edu.cn/|g' /etc/apt/sources.list
RUN apt-get update

# install basic
RUN apt-get install -y vim curl wget unzip iputils-ping net-tools lsof tzdata
# timezone
RUN ln -fs /usr/share/zoneinfo/Asia/Shanghai /etc/localtime

# install php and nginx
RUN apt-get install -y php7.4-common php7.4-curl php7.4-json php7.4-zip php7.4-readline php7.4-mbstring php7.4-xml
RUN apt-get install -y php7.4-mysql php7.4-redis php7.4-pgsql php7.4-sqlite3
RUN apt-get install -y nginx php7.4-fpm

# composer 2
# COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# config files
ADD ./dockerfiles/nginx/nginx.conf /etc/nginx/nginx.conf
ADD ./dockerfiles/nginx/vhost/ /etc/nginx/vhost
ADD ./dockerfiles/php/fpm-www.conf /etc/php/7.4/fpm/pool.d/www.conf

# project files
ADD ./ /var/www/fpm-ng

# start script
ADD ./dockerfiles/*.sh /bin/
RUN chmod +x /bin/*.sh
CMD ["start.sh"]


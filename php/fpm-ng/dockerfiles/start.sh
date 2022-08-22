#!/bin/bash

# start nginx (daemon)
service nginx start
# start php-fpm (non deamon)
exec php-fpm7.4 -F

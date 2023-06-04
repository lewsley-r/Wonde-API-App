FROM cyberduck/php-fpm-laravel:8.1

COPY ./php.ini /usr/local/etc/php

COPY . /var/www/app

RUN mkdir -p /var/www/app/storage; (chown -R :www-data /var/www/app/storage && chmod -R g+rwX /var/www/app/storage)

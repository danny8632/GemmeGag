FROM php:apache

RUN docker-php-ext-install mysqli

ENV PHP_UPLOAD_MAX_FILESIZE 256M

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

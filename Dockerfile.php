FROM php:8-apache


RUN a2enmod rewrite

WORKDIR /var/www/html

COPY src/ /var/www/html

EXPOSE 80

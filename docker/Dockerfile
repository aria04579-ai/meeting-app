FROM php:8.2-apache

RUN a2enmod rewrite



COPY /app /var/www/html/

HEALTHCHECK CMD curl -f http://localhost || exit 1

# Official PHP image with Apache included
FROM php:8.4-apache

# Render gives the container a PORT variable (default 10000). Point Apache at it.
ENV PORT=10000
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf \
 && sed -i 's/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/' /etc/apache2/sites-available/000-default.conf \
 && echo "ServerName localhost" > /etc/apache2/conf-available/servername.conf \
 && a2enconf servername

# Public files go in the web root. Shared PHP code stays outside it.
COPY public/ /var/www/html/
COPY src/ /var/www/src/

EXPOSE 10000

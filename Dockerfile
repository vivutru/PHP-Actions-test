# Official PHP image with Apache already included
FROM php:8.4-apache

# Render tells the container which port to use through the PORT variable.
# Default to 10000 (Render's default), then point Apache at it.
ENV PORT=10000
RUN sed -i 's/Listen 80/Listen ${PORT}/' /etc/apache2/ports.conf \
 && sed -i 's/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/' /etc/apache2/sites-available/000-default.conf \
 && echo "ServerName localhost" > /etc/apache2/conf-available/servername.conf \
 && a2enconf servername

# Copy the site into Apache's web root
COPY public/ /var/www/html/

EXPOSE 10000

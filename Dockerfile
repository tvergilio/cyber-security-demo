FROM php:8.1-apache

# Install SQLite extension
RUN apt-get update && apt-get install -y libsqlite3-dev && docker-php-ext-install pdo_sqlite

# Copy your application code
COPY ./app /var/www/html/

# Expose port 80
EXPOSE 80

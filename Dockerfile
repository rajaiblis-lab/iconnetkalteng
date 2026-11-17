# Gunakan image PHP 7.3 dengan Apache
FROM php:7.3-apache

# Aktifkan mod_rewrite untuk Apache
RUN a2enmod rewrite

# Install ekstensi PHP yang dibutuhkan CodeIgniter dan PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Set direktori kerja di dalam container
WORKDIR /var/www/html

# Salin semua file project ke dalam container
COPY . /var/www/html

# Set permission untuk file project
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Expose port 80 untuk Apache
EXPOSE 80

# Menggunakan image PHP 8.4 resmi dengan Apache web server
FROM php:8.4-apache

# Install dependensi sistem dan ekstensi PHP yang mendukung caching_sha256_password
RUN apt-get update && apt-get install -y \
    libssl-dev \
    && docker-php-ext-install mysqli pdo_mysql \
    && docker-php-ext-enable mysqli pdo_mysql

# Copy semua file project dari GitHub ke dalam container Apache
COPY . /var/www/html/

# Ubah port Apache dari default 80 ke 8080 karena Cloud Run mendengarkan port 8080
RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Berikan hak akses folder ke Apache (menggunakan -R kapital)
RUN chown -R www-data:www-data /var/www/html

EXPOSE 8080

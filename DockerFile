# Menggunakan image PHP resmi yang sudah include Apache web server
FROM php:8.4-apache

# Install ekstensi mysqli yang diperlukan untuk koneksi database MySQL
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy semua file project dari komputer/GitHub ke dalam container Apache
COPY . /var/www/html/

# Ubah port Apache dari default 80 ke 8080 karena Cloud Run mendengarkan port 8080
RUN sed -i 's/80/8080/g' /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

# Berikan hak akses folder ke Apache
RUN chown -r www-data:www-data /var/www/html

EXPOSE 8080

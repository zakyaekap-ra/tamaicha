FROM php:8.2-apache

# Menginstal ekstensi mesin PHP pendukung Laravel
RUN apt-get update -y && apt-get install -y libzip-dev zip unzip
RUN docker-php-ext-install zip pdo_mysql

# Mengaktifkan sistem routing web
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Memasukkan seluruh kode web Anda
COPY . /var/www/html

# Menginstal Composer (Perakit Laravel)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Memberikan hak akses folder keamanan
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
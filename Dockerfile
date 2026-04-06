FROM php:8.4-apache

RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    && docker-php-ext-install intl pdo_mysql mysqli zip \
    && a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html/tmp /var/www/html/logs /var/www/html/webroot

EXPOSE 80

CMD ["apache2-foreground"]

FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html
ENV APACHE_DOCUMENT_ROOT /var/www/html/webroot
RUN sed -i 's|/var/www/html|/var/www/html/webroot|g' /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite
EXPOSE 80FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html

RUN a2enmod rewrite

COPY .docker/apache.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80

CMD ["apache2-foreground"]
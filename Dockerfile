FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mysqli

# Включаем модуль перенаправления URL
RUN a2enmod rewrite

# Указываем Apache искать файлы внутри папки autokool, если они там лежат
# (При необходимости измените /var/www/html на путь с вашей подпапкой)
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Меняем стандартный путь Apache в конфигурационном файле
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

WORKDIR /var/www/html
COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html
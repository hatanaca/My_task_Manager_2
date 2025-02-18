FROM php:8.0-fpm

#install dependencies
RUN apt-get update && apt-get install -y \
	libpq-dev \
	git \
	unzip \
	&& docker-php-ext-install pdo_pgsql

#Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer	

WORKDIR /var/www
COPY . .
RUN composer install

EXPOSE 8000
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]



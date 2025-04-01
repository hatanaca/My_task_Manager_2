FROM php:8.2-fpm

# Instala dependências do sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    curl \
    unzip \
    git \
    iputils-ping \
    && docker-php-ext-install pdo pdo_pgsql

# Configura PHP-FPM
RUN echo "listen = 0.0.0.0:9000" > /usr/local/etc/php-fpm.d/zz-docker.conf

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Configura diretório de trabalho
WORKDIR /var/www/html

# Copia apenas os arquivos necessários para instalação de dependências
COPY . .

# Instala dependências com cache
RUN composer install --no-interaction --optimize-autoloader --no-dev && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache && \
    php artisan config:cache && \
    php artisan route:cache
# Copia o restante da aplicação
COPY . .

# Configura permissões
RUN chown -R www-data:www-data storage \
    && chmod -R 775 storage \
    && composer dump-autoload --optimize

CMD ["php-fpm", "-F"]

FROM php:8.2-fpm-alpine

# Устанавливаем системные зависимости и PHP-расширения
RUN apk add --no-cache \
    bash \
    git \
    unzip \
    libzip-dev \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    oniguruma-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
    bcmath \
    gd \
    mbstring \
    pdo_mysql \
    zip \
    opcache

# Создаем пользователя с тем же UID/GID, что и на хосте (для прав доступа)
ARG UID=1000
ARG GID=1000
RUN addgroup -g ${GID} -S laravel && adduser -u ${UID} -S laravel -G laravel

# Копируем настройки PHP (рекомендую создать php.ini в папке dockerfiles)
#COPY php.ini /usr/local/etc/php/conf.d/app.ini

USER laravel

WORKDIR /var/www/laravel

CMD ["php-fpm", "-F"]
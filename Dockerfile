FROM kooldev/php:8.1-nginx

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

ENV APP_ENV local
WORKDIR /app
ADD . .

RUN chown -R www-data:www-data /app

FROM kooldev/php:8.1-nginx

ENV APP_ENV production

RUN chown -R www-data:www-data /app

FROM kooldev/php:8.1-nginx

ENV APP_ENV production

EXPOSE 443

RUN chown -R www-data:www-data /app

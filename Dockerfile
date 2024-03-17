FROM kooldev/php:8.2-nginx

ENV APP_ENV production

EXPOSE 443

RUN chown -R www-data:www-data /app

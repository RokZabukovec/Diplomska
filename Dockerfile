FROM kooldev/php:8.1-nginx

ENV APP_ENV production

COPY ./data/nginx/app.conf /etc/nginx

RUN chown -R www-data:www-data /app

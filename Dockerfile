FROM php:8.2-apache
WORKDIR /var/www/html
COPY . .

EXPOSE 80

RUN apt-get update && \
    apt-get install -y default-mysql-client && \
    docker-php-ext-install pdo pdo_mysql

RUN docker-php-ext-enable mysqli

RUN echo "extension=pdo_mysql" > /usr/local/etc/php/conf.d/pdo_mysql.ini

ENV MYSQL_HOST=localhost \
    MYSQL_PORT=3306 \
    MYSQL_USER=root \
    MYSQL_PASSWORD= \
    MYSQL_DATABASE=allevents

CMD ["apache2-foreground"]

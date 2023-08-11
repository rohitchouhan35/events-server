# FROM php:8.0-apache
# WORKDIR /var/www/html
# COPY src/ .
# EXPOSE 80
# RUN apt-get update && \
#     apt-get install -y default-mysql-client
# ENV MYSQL_HOST=localhost \
#     MYSQL_PORT=3306 \
#     MYSQL_USER=root \
#     MYSQL_PASSWORD=secret \
#     MYSQL_DATABASE=myappdb

# # Install PDO extension for MySQL
# RUN docker-php-ext-install pdo pdo_mysql
# CMD ["apache2-foreground"]

FROM php:8.2-apache
WORKDIR /var/www/html
COPY . .
EXPOSE 80
CMD ["apache2-foreground"]

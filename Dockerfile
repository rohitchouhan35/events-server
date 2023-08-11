FROM php:8.2-apache

# Set the working directory
WORKDIR /var/www/html

# Copy the code into the container
COPY . .

# Expose port 80
EXPOSE 80

# Install MySQL client and required PHP extensions
RUN apt-get update && \
    apt-get install -y default-mysql-client && \
    docker-php-ext-install pdo pdo_mysql

# Enable mysqli extension
RUN docker-php-ext-enable mysqli

# Set PHP configuration to enable pdo_mysql extension
RUN echo "extension=pdo_mysql" > /usr/local/etc/php/conf.d/pdo_mysql.ini

# Define environment variables for database connection
ENV MYSQL_HOST=localhost \
    MYSQL_PORT=3306 \
    MYSQL_USER=root \
    MYSQL_PASSWORD= \
    MYSQL_DATABASE=allevents

CMD ["apache2-foreground"]

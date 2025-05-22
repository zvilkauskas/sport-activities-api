FROM php:8.4-fpm-alpine

# Install required packages
RUN apk add --no-cache bash mysql-client

# Set up the application directory
RUN mkdir -p /var/www/html

WORKDIR /var/www/html

# Install Composer
COPY --from=composer:2.8.8 /usr/bin/composer /usr/local/bin/composer

# Add Laravel user
RUN addgroup -g 1000 --system laravel \
    && adduser -G laravel --system -D -s /bin/sh -u 1000 laravel

# Configure PHP
RUN sed -i "s/user = www-data/user = laravel/g" /usr/local/etc/php-fpm.d/www.conf \
    && sed -i "s/group = www-data/group = laravel/g" /usr/local/etc/php-fpm.d/www.conf \
    && echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf

# Install PHP extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions mbstring pdo_mysql zip exif pcntl gd memcached

# Execute start.sh script to handle scheduler and queues
COPY start.sh /usr/local/bin/start
RUN chmod +x /usr/local/bin/start
CMD ["/usr/local/bin/start"]

USER laravel
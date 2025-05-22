FROM nginx:stable-alpine

# Set up the application directory
RUN mkdir -p /var/www/html

# Add Laravel user
RUN addgroup -g 1000 --system laravel \
    && adduser -G laravel --system -D -s /bin/sh -u 1000 laravel

# Remove unused groups
RUN delgroup dialout

# Update nginx configuration
RUN sed -i "s/user  nginx/user laravel/g" /etc/nginx/nginx.conf

# Copy custom nginx configuration
ADD nginx/default.conf /etc/nginx/conf.d/
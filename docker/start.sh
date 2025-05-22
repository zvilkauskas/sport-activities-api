docker/start.sh file:
#!/usr/bin/env bash

set -e

role=${CONTAINER_ROLE:-app}

if [ "$role" = "app" ]; then

    exec php-fpm -y /usr/local/etc/php-fpm.conf -R

elif [ "$role" = "queue" ]; then

    php /var/www/html/artisan queue:work -vv --no-interaction --tries=3 --sleep=5 --timeout=300 --delay=10

elif [ "$role" = "scheduler" ]; then

    while [ true ]
            do
              php /var/www/html/artisan schedule:run -vv --no-interaction
              sleep 60
            done

elif [ "$role" = "artisan" ]; then
    exec php /var/www/html/artisan "$@"

else
    echo "Could not match the container role \"$role\""
    exit 1
fi
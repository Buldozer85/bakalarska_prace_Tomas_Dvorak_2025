web: heroku-php-apache2 public/ && npm run build
worker: php artisan queue:restart && php artisan queue:work --tries=3 --queue=default,messages

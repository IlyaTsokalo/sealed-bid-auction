FROM php:8.2-cli

RUN mkdir "app"
WORKDIR /app

COPY composer.json composer.lock /app/

RUN apt-get update && apt-get install -y \
    git \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install --no-scripts --no-autoloader

COPY . /app

CMD ["vendor/bin/phpunit", "tests"]
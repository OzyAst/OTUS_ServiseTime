ARG PHP_VERSION

FROM php:${PHP_VERSION}
RUN apt-get update && apt-get install -y \
            make g++ gcc zlib1g zlib1g-dev curl libcurl4-openssl-dev libcurl4 libevent-dev libidn11-dev \
            libssl-dev git && \
            apt-get clean && \
            rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* && \
            rm /var/log/lastlog /var/log/faillog

RUN pecl install -of redis docker-php-ext-enable redis

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- \
        --filename=composer \
        --install-dir=/usr/local/bin && \
        echo "alias composer='composer'" >> /root/.bashrc && \
        composer

RUN docker-php-ext-install pdo_mysql && \
    docker-php-ext-install pcntl
RUN pecl install -of xdebug && docker-php-ext-enable xdebug

RUN groupmod -o -g 1000 www-data && \
    usermod -o -u 1000 -g www-data www-data

WORKDIR /var/www/html
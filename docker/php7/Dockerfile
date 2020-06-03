FROM php:7.4-fpm

RUN apt-get update && \
    apt-get install -y \
            libzip-dev \
            libxml2-dev \
            nano

RUN cd / && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install \
    zip \
    pdo \
    pdo_mysql \
    bcmath

# Set the timezone.
ENV TZ=Europe/Moscow
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

COPY ./config/ /usr/local/etc/

WORKDIR /var/www
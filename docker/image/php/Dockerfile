FROM php:8.0.8-cli
ARG UID=1000

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#install some base extensions

RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y \
    libzip-dev \
    zip \
    git \
  && docker-php-ext-install zip

RUN adduser --disabled-password --gecos "" --no-create-home --ingroup www-data --uid ${UID} user
RUN mkdir -p /home/user/.composer/ && \
    chown user:www-data /home/user/.composer/

USER user

WORKDIR /var/www
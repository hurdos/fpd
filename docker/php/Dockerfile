FROM php:8.3-fpm

ENV DEBIAN_FRONTEND=noninteractive
#Install base packages, base config etc
USER root
RUN apt-get update
RUN apt-get install -y --allow-unauthenticated apt-transport-https apt-utils
RUN apt-get update
RUN apt-get install -y procps iproute2 curl bash-completion git inetutils-ping locales mc nano sudo tzdata wget libcurl4-openssl-dev xz-utils tar xdg-utils
RUN docker-php-ext-install mysqli

WORKDIR /var/www

CMD ["php-fpm"]
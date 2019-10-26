FROM php:7.3.11-apache

# Extensions PHP
RUN apt-get update && apt-get install -y \
        curl \
        git \
        zip \
        libicu-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql intl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY deploy/php.ini /usr/local/etc/php/

# Conf apache
RUN a2enmod rewrite
COPY deploy/vhost.conf /etc/apache2/sites-enabled/000-default.conf
COPY deploy/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod a+x /usr/local/bin/entrypoint.sh

COPY ./ /var/www/html

WORKDIR /var/www/html

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]

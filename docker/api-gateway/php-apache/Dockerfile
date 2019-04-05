FROM php:7.2.6-apache

# Extensions PHP
RUN apt-get update && apt-get install -y \
        curl \
        git \
        zip \
        libicu-dev \
        cron \
        supervisor \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql intl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY php.ini /usr/local/etc/php/

# Conf apache
RUN a2enmod rewrite
COPY vhost.conf /etc/apache2/sites-enabled/000-default.conf
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

# Configure cron
RUN crontab -l | { cat; echo "* * * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1"; } | crontab -

# Configure supervisor
COPY supervisord.conf /etc/supervisor/supervisord.conf

RUN version=$(php -r "echo PHP_MAJOR_VERSION.PHP_MINOR_VERSION;") \
    && curl -A "Docker" -o /tmp/blackfire-probe.tar.gz -D - -L -s https://blackfire.io/api/v1/releases/probe/php/linux/amd64/$version \
    && mkdir -p /tmp/blackfire \
    && tar zxpf /tmp/blackfire-probe.tar.gz -C /tmp/blackfire \
    && mv /tmp/blackfire/blackfire-*.so $(php -r "echo ini_get('extension_dir');")/blackfire.so \
    && printf "extension=blackfire.so\nblackfire.agent_socket=tcp://blackfire:8707\n" > $PHP_INI_DIR/conf.d/blackfire.ini \
    && rm -rf /tmp/blackfire /tmp/blackfire-probe.tar.gz

WORKDIR /var/www/html

EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
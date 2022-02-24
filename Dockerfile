FROM php:7.4.27-apache

WORKDIR /data/app
ENV APACHE_DOCUMENT_ROOT /data/app/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
    && a2enmod rewrite

##RUN docker-php-ext-install pdo_mysql
#COPY --from=composer:2.2.6 /usr/bin/composer /usr/bin/composer

ENTRYPOINT ["docker-php-entrypoint"]
CMD ["apache2-foreground"]

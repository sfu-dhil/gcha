FROM php:8.2-apache
WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libzip-dev \
        libapache2-mod-xsendfile \
        netcat-traditional \
        git-core \
        unzip \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libjpeg-dev \
        libmemcached-dev \
        zlib1g-dev \
        imagemagick \
        libmagickwand-dev \
        curl \
        ghostscript \
        poppler-utils \
        libsodium-dev \
        libicu-dev \
        nano \
        libvips-tools \
        apt-utils \
    && cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && a2enmod rewrite headers \
    && docker-php-ext-configure gd --with-jpeg=/usr/include/ --with-freetype=/usr/include/ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) iconv pdo pdo_mysql mysqli gd intl \
    && pecl install imagick mcrypt \
    && docker-php-ext-enable imagick mcrypt \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Add the Omeka PHP code
# Latest Omeka version, check: https://omeka.org/s/download/
ENV OMEKA_VERSION 3.1.2
RUN curl -L "https://github.com/omeka/Omeka/releases/download/v${OMEKA_VERSION}/omeka-${OMEKA_VERSION}.zip" -o /var/www/omeka-${OMEKA_VERSION}.zip \
    && unzip /var/www/omeka-${OMEKA_VERSION}.zip -d /var/www/ \
    && rm -Rf /var/www/omeka-${OMEKA_VERSION}.zip /var/www/html \
    && mv /var/www/omeka-${OMEKA_VERSION}/ /var/www/html

# default service settings
COPY docker/docker-entrypoint.sh /docker-entrypoint.sh
COPY docker/gcha.ini /usr/local/etc/php/conf.d/gcha.ini
COPY docker/image-policy.xml /etc/ImageMagick-6/policy.xml

# override omeka chinese language files
COPY docker/omeka/application/languages/zh_CN.mo docker/omeka/application/languages/zh_CN.po /var/www/html/application/languages/

# omeka settings
COPY --chown=www-data:www-data --chmod=771 docker/omeka/db.ini docker/omeka/robots.txt docker/omeka/.htaccess /var/www/html/
COPY --chown=www-data:www-data --chmod=771 docker/omeka/application/config/config.ini /var/www/html/application/config/config.ini
COPY --chown=www-data:www-data --chmod=771 themes /var/www/html/themes/
COPY --chown=www-data:www-data --chmod=771 plugins /var/www/html/plugins/

RUN chown www-data:www-data -R themes/ plugins/ \
    && chmod 771 -R themes/ plugins/

CMD ["/docker-entrypoint.sh"]
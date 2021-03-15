FROM php:7.0-apache


RUN apt-get update && \
    apt-get install -y git

RUN apt-get update && apt-get install -y mysql-client && rm -rf /var/lib/apt
RUN mkdir /var/run/mysqld
RUN mkfifo /var/run/mysqld/mysqld.sock
RUN chown -R root /var/run/mysqld
RUN docker-php-ext-install\
    pdo_mysql \
    && a2enmod \
    && a2enmod headers \
    rewrite
RUN apt-get update -y
RUN apt-get install -y  re2c libmhash-dev libmcrypt-dev file
RUN apt-get update && apt-get install -y \
        libicu-dev \
    && docker-php-ext-install \
        intl \
        opcache \
    && docker-php-ext-enable \
        intl \
        opcache

RUN apt-get install -y zip unzip zlib1g-dev libpng-dev
RUN apt-get install -y --no-install-recommends \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libxpm-dev \
    libvpx-dev \
&& docker-php-ext-configure gd \
    --with-freetype-dir=/usr/lib/x86_64-linux-gnu/ \
    --with-jpeg-dir=/usr/lib/x86_64-linux-gnu/ \
    --with-xpm-dir=/usr/lib/x86_64-linux-gnu/ \
    --with-vpx-dir=/usr/lib/x86_64-linux-gnu/ \
&& docker-php-ext-install gd
RUN apt-get install -y zlib1g-dev -y
RUN docker-php-ext-install zip
RUN docker-php-ext-install pcntl
RUN apt-get install -y libgmp-dev re2c libmhash-dev libmcrypt-dev file
RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/
RUN docker-php-ext-configure gmp
RUN docker-php-ext-install gmp

RUN apt install -y libc-client-dev libkrb5-dev && rm -r /var/lib/apt/lists/*
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl && docker-php-ext-install imap
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --version=1.10.16
#RUN mv composer.phar /usr/local/bin/composer

RUN apt-get update && apt-get install -my wget gnupg
RUN apt-get update && apt-get install -y apt-transport-https
RUN apt-get purge nodejs
RUN curl -sL https://deb.nodesource.com/setup_11.x | bash -

RUN apt-get install -y nodejs

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

FROM php:7.1.20-apache

#ENV http_proxy <PROXY:PORT>
#ENV https_proxy <PROXY:PORT>
#RUN pear config-set <PROXY:PORT>

RUN apt-get -y update --fix-missing
RUN apt-get upgrade -y

# Install useful tools
RUN apt-get -y install apt-utils nano wget dialog expect gnuplot bc

# Install important libraries
RUN apt-get -y install --fix-missing apt-utils build-essential git curl libcurl3 libcurl3-dev zip

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install xdebug
RUN pecl install xdebug-2.5.0
RUN docker-php-ext-enable xdebug

# Other PHP7 Extensions

RUN apt-get -y install libmcrypt-dev
RUN docker-php-ext-install mcrypt
RUN docker-php-ext-install curl
RUN docker-php-ext-install tokenizer
RUN docker-php-ext-install json

RUN apt-get -y install zlib1g-dev
RUN docker-php-ext-install zip

RUN apt-get -y install libicu-dev
RUN docker-php-ext-install -j$(nproc) intl

RUN docker-php-ext-install mbstring

RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev
RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ 
RUN docker-php-ext-install -j$(nproc) gd

# Enable apache modules
RUN a2enmod rewrite headers

# Update
EXPOSE 80 443
COPY ./www /var/www/html
COPY ./config/php/php.ini /usr/local/etc/php/php.ini
COPY ./config/vhosts /etc/apache2/sites-enabled
WORKDIR /var/www/html
ENTRYPOINT ["/var/www/html/sarFILE/entrypoint.sh"]

FROM ubuntu:16.04

# Maintainer
LABEL maintainer "alexsander.pereira@icloud.com"

# Create app directory
WORKDIR /var/www/html

# Add repository to install php7.1
RUN apt-get update && apt-get -y install software-properties-common
RUN export LANG=C.UTF-8 && add-apt-repository ppa:ondrej/php

# Install nginx, git, unzip, mysql-client, php7.1, php7.1-fpm, php7.1-xml, php7.1-mbstring, php7.1-zip, php7.1-mysql
RUN apt-get update && apt-get install -y nginx git unzip mysql-client php7.1 php7.1-fpm php7.1-xml php7.1-mbstring php7.1-zip php7.1-mysql && apt-get clean

# Configure nginx default file
RUN rm /etc/nginx/sites-available/default
ADD ./default /etc/nginx/sites-available/default

# Install and configure COMPOSER
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && php composer-setup.php && rm composer-setup.php && mv composer.phar /usr/local/bin/composer && chmod a+x /usr/local/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

# Install app dependencies
COPY composer.json ./
RUN composer install

# Bundle app source
COPY . .

EXPOSE 4444
CMD service php7.1-fpm start && nginx -g "daemon off;"
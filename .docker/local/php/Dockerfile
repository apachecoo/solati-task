FROM php:8.3-fpm-bookworm

COPY php.ini /usr/local/etc/php/
COPY docker.conf /usr/local/etc/php-fpm.d/docker.conf
COPY .bashrc /root/
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Crear un grupo y usuario llamado workspace
RUN groupadd -g 1000 workspace && \
  useradd -u 1000 -g workspace -m -s /bin/bash workspace

# Instalar paquetes necesarios
RUN apt-get update \
  && apt-get install -y build-essential zlib1g-dev default-mysql-client curl gnupg procps vim git unzip libzip-dev libpq-dev nano cron supervisor \
  && docker-php-ext-install zip pdo_mysql pdo_pgsql pgsql

RUN apt-get update && apt-get install -y \
  unixodbc \
  unixodbc-dev \
  odbcinst \
  libodbc1

# Microsoft ODBC Driver for SQL Server
RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - && \
  curl https://packages.microsoft.com/config/debian/11/prod.list > /etc/apt/sources.list.d/mssql-release.list && \
  apt-get update && ACCEPT_EULA=Y apt-get install -y msodbcsql18

# intl
RUN apt-get install -y libicu-dev \
  && docker-php-ext-configure intl \
  && docker-php-ext-install intl

# gd
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev && \
  docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ && \
  docker-php-ext-install gd

# pdo_odbc
RUN docker-php-ext-configure pdo_odbc --with-pdo-odbc=unixODBC,/usr && \
  docker-php-ext-install pdo_odbc

# Imagick
RUN apt-get update && apt-get install -y \
  imagemagick \
  libmagickwand-dev \
  gcc make && \
  git clone https://github.com/Imagick/imagick.git && \
  cd imagick && \
  phpize && \
  ./configure && \
  make && \
  make install && \
  docker-php-ext-enable imagick

# Permitir manipulación de archivos PDF en ImageMagick
RUN sed -i 's/<policy domain="coder" rights="none" pattern="PDF" \/>//g' /etc/ImageMagick-6/policy.xml

# redis
#RUN pecl install redis && docker-php-ext-enable redis

# pcov
#RUN pecl install pcov && docker-php-ext-enable pcov

# Xdebug
# RUN pecl install xdebug \
# && docker-php-ext-enable xdebug \
# && echo ";zend_extension=xdebug" > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Node.js, NPM, Yarn
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs
RUN npm install npm@latest -g
RUN npm install yarn -g

# Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin
RUN composer config --global process-timeout 3600
RUN composer global require "laravel/installer"

# Cambiar el propietario del directorio de trabajo al usuario workspace
RUN chown -R workspace:workspace /var/www

WORKDIR /root
RUN git clone https://github.com/seebi/dircolors-solarized

# Este archivo se encarga de asignar permisos a directorios y archivos
COPY ./scripts/init.sh /usr/local/bin/init.sh
RUN chmod +x /usr/local/bin/init.sh

# Crear y agregar tu crontab
COPY laravel_cron /etc/cron.d/laravel_cron

# Dar permisos al archivo crontab
RUN chmod 0644 /etc/cron.d/laravel_cron

# Aplicar el crontab
RUN crontab /etc/cron.d/laravel_cron

EXPOSE 5173

# Cambiar al usuario workspace
USER root

WORKDIR /var/www

# Iniciar supervisord al iniciar el contenedor
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

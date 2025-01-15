FROM php:8.3-fpm

# Instalar pacotes necessários
RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    git \
    libpq-dev \
    libonig-dev \
    libzip-dev \
    default-libmysqlclient-dev \
    && apt-get clean

# Instalar as extensões do PHP
RUN docker-php-ext-install pdo pdo_mysql mbstring zip

RUN pecl install xdebug
RUN docker-php-ext-enable xdebug

# Criar diretório de configuração se necessário e configurar o Xdebug
RUN mkdir -p /etc/php/8.3/fpm/conf.d && \
    echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name 'xdebug.so')" > /etc/php/8.3/fpm/conf.d/20-xdebug.ini && \
    echo "xdebug.mode=${XDEBUG_MODE}" >> /etc/php/8.3/fpm/conf.d/20-xdebug.ini && \
    echo "xdebug.start_with_request=yes" >> /etc/php/8.3/fpm/conf.d/20-xdebug.ini && \
    echo "xdebug.client_host=${XDEBUG_CLIENT_HOST}" >> /etc/php/8.3/fpm/conf.d/20-xdebug.ini && \
    echo "xdebug.client_port=${XDEBUG_CLIENT_PORT}" >> /etc/php/8.3/fpm/conf.d/20-xdebug.ini && \
    echo "xdebug.log_level=0" >> /etc/php/8.3/fpm/conf.d/20-xdebug.ini && \
    echo "xdebug.discover_client_host=true" >> /etc/php/8.3/fpm/conf.d/20-xdebug.ini

# Copiar o código da aplicação
COPY . /var/www/html

# Ajustar permissões
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache && \
    chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Definir diretório de trabalho
WORKDIR /var/www/html

# Instalar o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependências do Composer
RUN composer install --no-dev --optimize-autoloader

# Iniciar o PHP-FPM
CMD ["php-fpm"]

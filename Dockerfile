FROM php:8.2-fpm

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Instalar dependências do sistema
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo_mysql

# Instalar Composer manualmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar Node.js e npm
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Copiar o conteúdo do projeto
COPY . .

# Ajustar permissões do diretório public
RUN chown -R www-data:www-data /var/www/html/public

# Instalar dependências PHP
RUN composer install

# Instalar dependências Node.js
RUN npm install

# Build dos assets com Vite
RUN npm run build

# Expor a porta
EXPOSE 9000

# Comando para iniciar o PHP-FPM
CMD ["php-fpm"]

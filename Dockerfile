FROM php:8.2-apache

# Enable Apache rewrite
RUN a2enmod rewrite

# Install git, unzip, libzip-dev for Composer & zip extension
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    && docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set Apache document root to /public
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Update Apache config to use new doc root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/sites-available/*.conf

WORKDIR /var/www/html

# Install dependencies first for better caching
COPY composer.json composer.lock* ./
RUN composer install --no-dev --optimize-autoloader

# Copy project files
COPY . .

# Permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]

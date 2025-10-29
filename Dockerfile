FROM php:8.2-apache

# Enable Apache rewrite
RUN a2enmod rewrite

# Install system dependencies (git + unzip)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && docker-php-ext-install zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Copy composer files and install dependencies
COPY composer.json composer.lock* ./

RUN composer install --no-dev --optimize-autoloader

# Copy project files
COPY . .

# Fix permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]

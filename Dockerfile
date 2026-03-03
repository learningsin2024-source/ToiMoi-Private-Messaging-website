FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy only package folder contents into Apache root
COPY package/ /var/www/html/

# Enable rewrite (good practice)
RUN a2enmod rewrite

EXPOSE 80
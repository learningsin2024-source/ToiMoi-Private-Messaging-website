FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Fix Apache MPM conflict
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy project files to Apache web root
COPY project/ /var/www/html/

# Enable rewrite module
RUN a2enmod rewrite

EXPOSE 80
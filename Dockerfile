FROM php:8.2-cli

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy project files
COPY project/ /app/

# Set working directory
WORKDIR /app

EXPOSE 80

CMD ["php", "-S", "0.0.0.0:80", "-t", "/app"]
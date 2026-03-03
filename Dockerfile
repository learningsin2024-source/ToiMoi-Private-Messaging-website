FROM php:8.2-cli

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy project files
COPY project/ /app/

WORKDIR /app

EXPOSE ${PORT:-80}

CMD php -S 0.0.0.0:${PORT:-80} -t /app
FROM php:8.2-cli

RUN docker-php-ext-install mysqli

COPY project/ /app/

WORKDIR /app

EXPOSE ${PORT:-80}

CMD php -S 0.0.0.0:${PORT:-80} -t /app
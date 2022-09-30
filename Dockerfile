# builds a container for a LAMP web app to track my weight.

# ARG NODE_VERSION=8.11-slim
FROM php:7.4.3-apache
LABEL "about"="LAMP web app to track my weight"
ENV TZ "America/Phoenix"
RUN docker-php-ext-install mysqli pdo pdo_mysql mysqli
COPY source/*.php /var/www/html/
COPY Scripts/*.js /var/www/html/Scripts/
EXPOSE 80

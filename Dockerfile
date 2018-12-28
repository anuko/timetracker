FROM php:7.2-apache

# Use the default production configuration.
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Override with custom settings.
# COPY config/php_tt.ini $PHP_INI_DIR/conf.d/

# Install mysqli extension.
RUN docker-php-ext-install mysqli

# Install gd extension.
RUN apt-get update && apt-get install libpng-dev -y \
 && docker-php-ext-install gd

# Install ldap extension.
RUN apt-get install libldap2-dev -y \
  && docker-php-ext-install ldap
# TODO: check if ldap works, as the above is missing this step:
# && docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \

# Cleanup. The intention was to keep image size down.
# RUN rm -rf /var/lib/apt/lists/*
#
# The above does not work. Files are removed, but
# image files (zipped or not) are not getting smaller. Why?

COPY . /var/www/html/


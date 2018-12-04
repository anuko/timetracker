FROM php:7.2-apache

# LDAP requirements
RUN \
    apt-get update && \
    apt-get install libldap2-dev -y && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
    docker-php-ext-install ldap

# GD requirements
RUN \
    apt-get update && \
    apt-get install libpng-dev -y && \
    rm -rf /var/lib/apt/lists/* && \
    docker-php-ext-install gd

# MYSQLI
RUN docker-php-ext-install mysqli

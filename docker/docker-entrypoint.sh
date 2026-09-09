#!/bin/bash
set -e

# app specific setup here
touch /var/www/html/application/logs/errors.log
mkdir -p /php-sessions
chown www-data:www-data /php-sessions

apache2-foreground
#!/bin/bash
set -e

# app specific setup here
touch /var/www/html/application/logs/errors.log

apache2-foreground
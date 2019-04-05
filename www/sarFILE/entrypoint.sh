#!/bin/bash

mkdir -p /var/www/html/sarDATA/uPLOAD
chown -R www-data.www-data /var/www/html
source /etc/apache2/envvars
exec apache2 -D FOREGROUND

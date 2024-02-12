cd /var/www/html
chown -R www-data.www-data /var/www/*
chmod 660 config.local.php
chmod 770 images/guilds
chmod 660 images/houses
chmod 660 images/gallery
chmod -R 770 system/cache
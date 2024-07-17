![](https://viavictor.com/logos/Viavictor_Logo_Logo_Zwart.png)

------------

installation instructions
-------------------------
1. copy .env.example to .env and fill in correct variables
2. execute `composer install` (in docker container)
3. remove wp/wp-content folder
4. copy .htaccess into wp folder and changes contents to:

        # BEGIN WordPress
        <IfModule mod_rewrite.c>
        RewriteEngine On
        RewriteBase /wp/
        RewriteRule ^index\.php$ - [L]
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . /wp/index.php [L]
        </IfModule>
        # END WordPress
5. copy wp-config-sample.php to wp-config.php


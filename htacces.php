RewriteEngine On

# Remove .php from URLs
RewriteCond %{THE_REQUEST} /([^.]+)\.php [NC]
RewriteCond %{REQUEST_URI} !^/dept/ [NC]  # Exclude dept/ from .php removal
RewriteRule (.*) /%1 [R=302,L]  
RewriteCond %{REQUEST_FILENAME}\.php -f
RewriteCond %{REQUEST_URI} !^/dept/ [NC]  # Exclude dept/ from .php check
RewriteRule ^(.*)$ $1.php

# Redirect /dept/ce to /dept.php?dept_name=ce
RewriteRule ^dept/([a-zA-Z0-9_-]+)$ dept/index.php?dept_id=$1 [L,QSA]
RewriteRule ^news-details/([a-zA-Z0-9_-]+)$ news-details.php?news_id=$1 [L,QSA]

# ErrorDocument 404 http://localhost/BEC/404.php
# ErrorDocument 403 http://localhost/BEC/404.php
# DirectoryIndex disabled
Options -Indexes




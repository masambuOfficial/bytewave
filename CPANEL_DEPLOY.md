cd ~/bytewave_app

# backups (do these if you haven't already)
cp public/.htaccess ~/htaccess.server.bak
cp public/sitemap.xml ~/sitemap.server.bak

# discard the local edits so the pull can proceed
git checkout -- public/.htaccess public/sitemap.xml

# pull, then restore the cPanel block immediately
git pull origin main
cat >> public/.htaccess <<'EOF'

# php -- BEGIN cPanel-generated handler, do not edit
# Set the “ea-php81” package as the default “PHP” programming language.
<IfModule mime_module>
  AddHandler application/x-httpd-ea-php81 .php .php8 .phtml
</IfModule>
# php -- END cPanel-generated handler, do not edit
EOF

# rest of the deploy
composer install --no-dev --optimize-autoloader && php artisan migrate --force && php artisan optimize:clear && php artisan config:cache && php artisan route:cache && php artisan view:cache
php artisan sitemap:generate

Then verify:

tail -12 public/.htaccess
curl -I http://www.bytewaveinvestments.com
curl -I https://bytewaveinvestments.com/sitemap.xml

- .htaccess: the end of the file should show the new HTTPS/www rules near the top and your cPanel block at the bottom.
- The www curl: it should return a 301 to https://bytewaveinvestments.com/.
- The sitemap curl: it should return 200.

Two notes:
- Local edits: after this, .htaccess will show as locally modified on the server again. That's fine. Future pulls only fail if a commit changes .htaccess again. If that happens, repeat this same restore step.
- cPanel changes: if you change the PHP version in cPanel, it rewrites that block on the server, so leave it out of the repo.
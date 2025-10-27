#!/bin/bash
# Symlink setup script for cPanel Laravel deployment
# Run this in cPanel Terminal after cloning your repository

echo "Setting up Laravel symlinks for cPanel..."

# Navigate to public_html (adjust path as needed)
cd /home/$(whoami)/public_html

# Remove existing symlinks if they exist
rm -f css js images storage img fonts

# Create symlinks to Laravel public assets
# Adjust the path to match your Laravel installation
LARAVEL_PATH="/home/$(whoami)/public_html/your-project-name"

ln -sf $LARAVEL_PATH/public/css css
ln -sf $LARAVEL_PATH/public/js js  
ln -sf $LARAVEL_PATH/public/images images
ln -sf $LARAVEL_PATH/public/storage storage
ln -sf $LARAVEL_PATH/public/img img
ln -sf $LARAVEL_PATH/public/fonts fonts

# Create storage link (Laravel storage:link command)
cd $LARAVEL_PATH
php artisan storage:link

echo "Symlinks created successfully!"
echo "Assets should now be accessible at:"
echo "https://yourdomain.com/css/"
echo "https://yourdomain.com/js/"
echo "https://yourdomain.com/images/"
echo "https://yourdomain.com/storage/"

# Set proper permissions
chmod -R 755 storage bootstrap/cache
chmod 644 .env

echo "Permissions set successfully!"

# cPanel Image Loading Fix Guide

## Problem
Images stored in the database are not loading when the Laravel project is deployed to cPanel.

## Root Causes
1. **Missing Storage Symlink** - The `storage:link` command hasn't been run on cPanel
2. **Wrong File Permissions** - Storage directories don't have proper permissions
3. **Incorrect APP_URL** - The `.env` file has wrong URL configuration
4. **Files in Wrong Location** - Images might be in `public/storage` instead of `storage/app/public`

---

## ✅ Complete Fix (Step-by-Step)

### Step 1: SSH into cPanel Terminal
Log into your cPanel account and open the **Terminal** application.

### Step 2: Navigate to Your Laravel Project
```bash
cd /home/YOUR_USERNAME/public_html
# OR if Laravel is in a subdirectory:
cd /home/YOUR_USERNAME/public_html/your-laravel-folder
```

### Step 3: Remove Old Storage Symlink (if exists)
```bash
# Remove the old symlink
rm -rf public/storage

# Check if it's removed
ls -la public/
```

### Step 4: Create Storage Symlink
```bash
php artisan storage:link
```

**Expected Output:**
```
The [public/storage] link has been connected to [storage/app/public].
```

### Step 5: Set Proper Permissions
```bash
# Set storage permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Set storage subdirectories
chmod -R 775 storage/app/public
chmod -R 775 storage/framework
chmod -R 775 storage/logs

# Verify permissions
ls -la storage/
```

### Step 6: Verify Symlink
```bash
# Check if symlink exists
ls -la public/storage

# Should show something like:
# lrwxrwxrwx 1 user user 33 Oct 27 14:30 public/storage -> /home/user/public_html/storage/app/public
```

### Step 7: Check .env Configuration
```bash
nano .env
```

Make sure these are correct:
```env
APP_URL=https://yourdomain.com
FILESYSTEM_DISK=public
```

Press `CTRL+X`, then `Y`, then `ENTER` to save.

### Step 8: Clear All Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Then cache for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 9: Move Existing Images (if needed)
If images are currently in `public/storage/`, move them to `storage/app/public/`:

```bash
# Check current location
ls -la public/storage/

# If files exist there, move them
cp -r public/storage/* storage/app/public/
```

### Step 10: Test Image Access
Try accessing an image directly in your browser:
```
https://yourdomain.com/storage/services/image-name.jpg
https://yourdomain.com/storage/portfolios/image-name.jpg
```

---

## 🔍 Troubleshooting

### Issue 1: "Symlink already exists"
```bash
# Remove and recreate
rm public/storage
php artisan storage:link
```

### Issue 2: "Permission denied"
```bash
# Fix ownership (replace 'username' with your cPanel username)
chown -R username:username storage
chown -R username:username bootstrap/cache
chmod -R 775 storage
```

### Issue 3: Images still not loading
1. Check if files exist:
```bash
ls -la storage/app/public/services/
ls -la storage/app/public/portfolios/
ls -la storage/app/public/products/
ls -la storage/app/public/posts/
```

2. Check symlink:
```bash
readlink public/storage
# Should output: /home/username/public_html/storage/app/public
```

3. Check .htaccess in public folder:
```bash
cat public/.htaccess
```

### Issue 4: 404 on storage URLs
Make sure your `.htaccess` file in `public/` directory has:
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^storage/(.*)$ storage/$1 [L]
    # ... other rules
</IfModule>
```

---

## 📋 Quick Verification Checklist

- [ ] `php artisan storage:link` executed successfully
- [ ] `storage/app/public/` directory exists
- [ ] `public/storage` is a symlink (not a directory)
- [ ] Storage permissions are 775
- [ ] `.env` has correct `APP_URL`
- [ ] Images exist in `storage/app/public/services/`, etc.
- [ ] Can access images via browser: `https://yourdomain.com/storage/services/test.jpg`
- [ ] All caches cleared and recached

---

## 🚀 Alternative: Manual Symlink Creation

If `php artisan storage:link` doesn't work, create symlink manually:

```bash
# Remove old symlink/directory
rm -rf public/storage

# Create symlink manually
ln -s /home/YOUR_USERNAME/public_html/storage/app/public /home/YOUR_USERNAME/public_html/public/storage

# Verify
ls -la public/storage
```

---

## 📝 Important Notes

1. **Never store files directly in `public/storage`** - Always use `storage/app/public`
2. **Always run `storage:link` after deployment**
3. **Set proper permissions** - 775 for directories, 664 for files
4. **Clear caches** after any configuration changes
5. **Check .env file** - Make sure APP_URL matches your domain

---

## 🔗 Image URLs in Blade Templates

Your templates correctly use:
```blade
<img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}">
```

This assumes:
- Image path in DB: `services/image-name.jpg`
- Actual file location: `storage/app/public/services/image-name.jpg`
- Accessed via: `https://yourdomain.com/storage/services/image-name.jpg`

---

## Need More Help?

If images still don't load after following all steps:

1. Check Laravel logs: `storage/logs/laravel.log`
2. Check cPanel error logs
3. Verify file paths in database match actual files
4. Test with a fresh image upload through admin panel

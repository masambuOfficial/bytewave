# cPanel SSH Deployment (GitHub)

This is a quick reference for deploying the latest code to a cPanel-hosted Laravel project via SSH + Git.

## Current Server Layout (this project)

- Laravel project root: `/home/bytewave/bytewave_app` (this folder contains `artisan`)
- Web document root: usually `~/public_html`
- Recommended document root for Laravel: `/home/bytewave/bytewave_app/public`

## 1) SSH into your server

```bash
ssh USERNAME@YOUR_DOMAIN_OR_SERVER_IP
```

If your host uses a custom SSH port:

```bash
ssh -p 2222 USERNAME@YOUR_DOMAIN_OR_SERVER_IP
```

## 2) Go to your web root

Most cPanel accounts serve your domain from:

```bash
cd ~/public_html
```

NOTE: `public_html` often does NOT contain the Laravel `artisan` file. Laravel commands must be run from the Laravel project root (where `artisan` exists).

## 2b) Go to the Laravel project root (where `artisan` is)

For this project:

```bash
cd /home/bytewave/bytewave_app
```

## 3) Pull the latest code

If the repo is already set up in this folder:

```bash
git pull origin main
```

If your default branch is `master`, use:

```bash
git pull origin master
```

## 4) Install/update PHP dependencies (if needed)

From your project root (where `composer.json` is):

```bash
composer install --no-dev --optimize-autoloader
```

If `composer` is not available as a command, try:

```bash
which composer
php -v
```

If your server requires calling a specific PHP binary, you may need something like:

```bash
php -d detect_unicode=0 $(which composer) install --no-dev --optimize-autoloader
```

(Exact command depends on your host.)

## 5) Run database migrations (production)

```bash
php artisan migrate --force
```

## 6) Clear/cache Laravel

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## One-shot Deploy Sequence (recommended)

```bash
cd /home/bytewave/bytewave_app
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 7) File permissions (common cPanel issue)

If storage/logs or cache fails:

```bash
chmod -R 775 storage bootstrap/cache
```

(Your host may require different ownership/permissions.)

---

# Recommended Production Layout (More Secure)

Instead of putting the entire Laravel project inside `public_html`, a common pattern is:

- Project root: `~/project`
- Public web root: `~/public_html`

Then you either:

- Point the domain document root to `~/project/public` (best if cPanel allows it), OR
- Copy/symlink the contents of `~/project/public` into `~/public_html` and ensure `index.php` points to the correct paths.

For this project, the equivalent would be:

- Project root: `/home/bytewave/bytewave_app`
- Document root: `/home/bytewave/bytewave_app/public`

---

# First-time setup (if repo is NOT cloned yet)

## Option A: Clone into `public_html` (simple, less ideal)

```bash
cd ~/public_html
git clone https://github.com/YOUR_USERNAME/YOUR_REPO.git .
```

## Option B: Clone outside web root (recommended)

```bash
cd ~
git clone https://github.com/YOUR_USERNAME/YOUR_REPO.git project
```

Then configure your domain to serve `~/project/public`.

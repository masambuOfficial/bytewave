# Git Deployment Guide: IDE → GitHub → cPanel

![Git](https://img.shields.io/badge/Git-F05032?style=flat&logo=git&logoColor=white)
![GitHub](https://img.shields.io/badge/GitHub-181717?style=flat&logo=github&logoColor=white)
![cPanel](https://img.shields.io/badge/cPanel-FF6C2C?style=flat&logo=cpanel&logoColor=white)

A comprehensive guide for setting up automated deployment from your local IDE to GitHub and then to cPanel hosting for Laravel applications.

## 📋 Table of Contents

1. [Prerequisites](#prerequisites)
2. [GitHub Repository Setup](#github-repository-setup)
3. [Local Git Configuration](#local-git-configuration)
4. [cPanel Git Setup](#cpanel-git-setup)
5. [Production Environment Configuration](#production-environment-configuration)
6. [Deployment Workflow](#deployment-workflow)
7. [Automated Deployment](#automated-deployment)
8. [Troubleshooting](#troubleshooting)
9. [Best Practices](#best-practices)

## 🔧 Prerequisites

### Required Software
- **Git** installed on your local machine
- **GitHub account** with repository access
- **cPanel hosting** with Git Version Control feature
- **SSH access** to your hosting (optional but recommended)

### Required Access
- Admin access to your cPanel hosting
- Write permissions to your domain's public folder
- Database access for production environment

## 🚀 GitHub Repository Setup

### Step 1: Create New Repository

1. **Navigate to GitHub** and click "New Repository"
2. **Repository Settings**:
   ```
   Repository Name: your-project-name
   Description: Brief description of your project
   Visibility: Public or Private (your choice)
   Initialize: Don't add README, .gitignore, or license (if you have existing code)
   ```
3. **Click "Create Repository"**

### Step 2: Repository Naming Best Practices

**Good Repository Names:**
- `project-name-business-suite`
- `laravel-business-platform`
- `company-management-system`
- `portfolio-crm-laravel`

**Avoid:**
- Spaces or special characters
- Very long names
- Generic names like "website" or "app"

## 💻 Local Git Configuration

### Step 1: Initialize Git Repository

```bash
# Navigate to your project directory
cd C:\path\to\your\project

# Initialize git repository (if not already done)
git init

# Check current status
git status
```

### Step 2: Configure Git User (First Time Setup)

```bash
# Set your name and email (global configuration)
git config --global user.name "Your Name"
git config --global user.email "your.email@example.com"

# Verify configuration
git config --list
```

### Step 3: Add Files and Make Initial Commit

```bash
# Add all files to staging
git add .

# Check what will be committed
git status

# Make initial commit
git commit -m "Initial commit: Project setup with Laravel framework"

# Check commit history
git log --oneline
```

### Step 4: Connect to GitHub Repository

```bash
# Add GitHub remote origin
git remote add origin https://github.com/YOUR_USERNAME/your-repository-name.git

# Verify remote connection
git remote -v

# Set main branch and push
git branch -M main
git push -u origin main
```

### Step 5: Verify GitHub Upload

1. **Refresh your GitHub repository page**
2. **Confirm all files are uploaded**
3. **Check that README.md displays correctly**

## 🏠 cPanel Git Setup

### Step 1: Access Git Version Control

1. **Log into cPanel**
2. **Navigate to "Software" section**
3. **Click "Git Version Control"**
4. **Click "Create Repository"**

### Step 2: Configure Repository Settings

**Clone a Repository Settings:**
```
Clone URL: https://github.com/YOUR_USERNAME/your-repository-name.git
Repository Path: /public_html/your-project-folder
Repository Name: your-project-production
```

**Important Path Examples:**
```bash
# For subdomain or subfolder
/public_html/app

# For main domain
/public_html

# For specific project folder
/public_html/myproject
```

### Step 3: Complete Repository Creation

1. **Click "Create" button**
2. **Wait for cloning process** (may take 1-2 minutes)
3. **Verify success message**
4. **Check repository appears in list**

### Step 4: Configure Repository Settings

After creation:
1. **Click "Manage" next to your repository**
2. **Note the repository path**
3. **Configure pull settings if available**

## 🔧 Production Environment Configuration

### Step 1: Create Production Environment File

**In cPanel File Manager:**
1. **Navigate to your project folder**
2. **Create `.env` file** (copy from `.env.example`)
3. **Configure production settings**

### Step 2: Production .env Configuration

```env
# Application Settings
APP_NAME=YourAppName
APP_ENV=production
APP_KEY=base64:your-production-key-here
APP_DEBUG=false
APP_URL=https://yourdomain.com

# Database Configuration (cPanel MySQL)
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=cpanel_database_name
DB_USERNAME=cpanel_db_username
DB_PASSWORD=cpanel_db_password

# Mail Configuration (cPanel Email)
MAIL_MAILER=smtp
MAIL_HOST=mail.yourdomain.com
MAIL_PORT=587
MAIL_USERNAME=noreply@yourdomain.com
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"

# Session & Cache
SESSION_DRIVER=file
CACHE_DRIVER=file
QUEUE_CONNECTION=database

# Security
BCRYPT_ROUNDS=12
```

### Step 3: Set File Permissions

```bash
# In cPanel Terminal or via File Manager
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod 644 .env
```

### Step 4: Install Dependencies (if needed)

```bash
# Navigate to project directory
cd /home/username/public_html/your-project

# Install production dependencies
composer install --no-dev --optimize-autoloader

# Generate application key (if needed)
php artisan key:generate

# Cache configuration
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🔄 Deployment Workflow

### Daily Development Workflow

```bash
# 1. Make changes to your code locally
# 2. Test changes in local environment

# 3. Stage changes
git add .

# 4. Commit with descriptive message
git commit -m "Add user authentication feature"

# 5. Push to GitHub
git push origin main

# 6. Deploy to cPanel (manual method)
# Go to cPanel Git Version Control → Click "Pull or Deploy"
```

### Branch-Based Workflow (Recommended)

```bash
# Create feature branch
git checkout -b feature/new-feature

# Make changes and commit
git add .
git commit -m "Implement new feature"

# Push feature branch
git push origin feature/new-feature

# Create Pull Request on GitHub
# After review and merge to main:

# Switch back to main and pull changes
git checkout main
git pull origin main

# Deploy to production
# Use cPanel Git to pull latest main branch
```

## 🤖 Automated Deployment

### Step 1: Set Up Webhook (Advanced)

**In cPanel:**
1. **Go to Git Version Control**
2. **Click "Manage" on your repository**
3. **Look for "Webhook URL"** (if available)
4. **Copy the webhook URL**

**In GitHub:**
1. **Go to repository Settings**
2. **Click "Webhooks"**
3. **Click "Add webhook"**
4. **Configure webhook:**
   ```
   Payload URL: [cPanel webhook URL]
   Content type: application/json
   Events: Just the push event
   Active: ✓
   ```

### Step 2: Create Deployment Script

Create `deploy.sh` in your repository root:

```bash
#!/bin/bash

echo "Starting deployment..."

# Navigate to project directory
cd /home/username/public_html/your-project

# Pull latest changes
git pull origin main

# Install/update dependencies
composer install --no-dev --optimize-autoloader

# Clear and optimize caches
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run database migrations (use with caution)
# php artisan migrate --force

# Set proper permissions
chmod -R 755 storage bootstrap/cache

echo "Deployment completed successfully!"
```

Make it executable:
```bash
chmod +x deploy.sh
```

## 🔍 Troubleshooting

### Common Issues and Solutions

#### 1. Git Authentication Issues

**Problem:** `fatal: Authentication failed`

**Solutions:**
```bash
# Use personal access token instead of password
git remote set-url origin https://YOUR_TOKEN@github.com/username/repo.git

# Or use SSH (if configured)
git remote set-url origin git@github.com:username/repo.git
```

#### 2. cPanel Git Clone Fails

**Problem:** Repository cloning fails in cPanel

**Solutions:**
- Verify repository URL is correct and accessible
- Check if repository is public or if cPanel has access
- Ensure repository path doesn't already exist
- Contact hosting provider if Git feature is not available

#### 3. File Permission Errors

**Problem:** Laravel shows permission errors

**Solutions:**
```bash
# Set correct permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chown -R username:username /path/to/project
```

#### 4. Environment Configuration Issues

**Problem:** Application shows errors after deployment

**Solutions:**
- Verify `.env` file exists and has correct values
- Check database credentials are correct for cPanel
- Ensure `APP_KEY` is generated: `php artisan key:generate`
- Clear caches: `php artisan config:clear`

#### 5. Composer Dependencies Missing

**Problem:** Class not found errors

**Solutions:**
```bash
# Install dependencies
composer install --no-dev

# Update autoloader
composer dump-autoload

# Clear and cache config
php artisan config:cache
```

### Debug Commands

```bash
# Check Git status
git status
git log --oneline -5

# Check remote connections
git remote -v

# Check Laravel configuration
php artisan config:show
php artisan route:list
php artisan about

# Check file permissions
ls -la storage/
ls -la bootstrap/cache/
```

## ✅ Best Practices

### Security Best Practices

1. **Never commit sensitive files:**
   ```bash
   # Add to .gitignore
   .env
   .env.local
   .env.production
   /vendor/
   /node_modules/
   /storage/*.key
   ```

2. **Use environment variables:**
   - Store all sensitive data in `.env`
   - Use different `.env` for different environments
   - Never hardcode credentials in code

3. **Set proper file permissions:**
   ```bash
   # Directories: 755
   # Files: 644
   # Sensitive files: 600
   chmod 600 .env
   ```

### Development Best Practices

1. **Use descriptive commit messages:**
   ```bash
   # Good
   git commit -m "Add user authentication with email verification"
   
   # Bad
   git commit -m "fix stuff"
   ```

2. **Use branching strategy:**
   ```bash
   # Feature branches
   git checkout -b feature/user-auth
   
   # Bug fix branches
   git checkout -b bugfix/login-error
   
   # Release branches
   git checkout -b release/v1.0.0
   ```

3. **Regular backups:**
   - Backup database before major deployments
   - Keep local copies of important configurations
   - Document deployment procedures

### Performance Best Practices

1. **Optimize for production:**
   ```bash
   # Cache configurations
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   
   # Optimize autoloader
   composer install --optimize-autoloader --no-dev
   ```

2. **Monitor deployment:**
   - Check error logs after deployment
   - Test critical functionality
   - Monitor application performance

## 📚 Quick Reference Commands

### Git Commands
```bash
# Basic workflow
git add .
git commit -m "message"
git push origin main

# Branch management
git checkout -b new-branch
git merge branch-name
git branch -d branch-name

# Remote management
git remote -v
git remote add origin URL
git remote set-url origin NEW_URL
```

### Laravel Commands
```bash
# Environment
php artisan key:generate
php artisan config:cache
php artisan config:clear

# Database
php artisan migrate
php artisan db:seed
php artisan migrate:fresh --seed

# Cache management
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### cPanel File Permissions
```bash
# Standard Laravel permissions
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chmod 644 .env
chmod 644 composer.json
chmod 644 package.json
```

---

## 📞 Support

If you encounter issues:
1. Check the troubleshooting section above
2. Consult your hosting provider's documentation
3. Check Laravel and Git official documentation
4. Contact your hosting support team

---

**Created:** October 2025  
**Last Updated:** October 2025  
**Version:** 1.0

*This guide is designed to be a comprehensive reference for Git deployment workflows. Keep it updated as your deployment process evolves.*

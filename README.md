# BYTEWAVE

![Laravel](https://img.shields.io/badge/Laravel-12.0.2-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-4.0-38B2AC.svg)
![SQLite](https://img.shields.io/badge/SQLite-Local-003B57.svg)
![MySQL](https://img.shields.io/badge/MySQL-Production-4479A1.svg)

A comprehensive Laravel-based business management and portfolio website that combines public-facing company presentation with powerful backend business management tools. Built with modern web technologies and designed for scalability.

## Overview

BYTEWAVE is a full-stack web application that serves dual purposes:
1. **Public Website**: Professional company showcase with portfolio, services, products, and blog
2. **Business Management System**: Complete admin dashboard for managing clients, quotations, invoices, and business operations

### Key Features

#### Public Website
- **Company Portfolio**: Interactive showcase of past projects with detailed case studies
- **Service Catalog**: Comprehensive display of company services with rich descriptions
- **Product Showcase**: Feature products with pricing, availability, and specifications
- **Blog System**: Content management for company updates, insights, and SEO
- **Contact Forms**: Professional contact handling with email notifications
- **Responsive Design**: Mobile-first approach with Tailwind CSS

#### Business Management (Admin Area)
- **Client Services Management**: Track IT services offered to clients with rates and billing units
- **Quotation System**: Create, manage, and track client quotations with dynamic item addition
- **Invoice Management**: Comprehensive invoicing system with payment status tracking
- **Client Relationship Management**: Maintain client profiles and project history
- **User Management**: Role-based access control with admin privileges
- **Task Management**: Track project tasks and deliverables
- **Financial Reporting**: Generate reports for business insights

## Technology Stack

### Backend
- **Framework**: Laravel 12.0.2 (Latest)
- **PHP Version**: 8.2+
- **Authentication**: Laravel Sanctum
- **Database ORM**: Eloquent
- **Queue System**: Database-based queues
- **File Storage**: Laravel Storage with public disk
- **Email**: Laravel Mail with SMTP support

### Frontend
- **CSS Framework**: Tailwind CSS 4.0
- **Build Tool**: Vite 6.2.1
- **JavaScript**: Vanilla JS with modern ES6+
- **Icons**: Lucide Icons (recommended)
- **Responsive**: Mobile-first design

### Database
- **Local Development**: SQLite (lightweight, file-based)
- **Production**: MySQL (cPanel hosted)
- **Migration System**: Laravel migrations
- **Seeding**: Comprehensive database seeders

### Development Environment
- **Local Server**: XAMPP (Apache + PHP + MySQL)
- **Package Manager**: Composer (PHP) + npm (Node.js)
- **Version Control**: Git
- **Code Style**: Laravel Pint (PHP CS Fixer)

## Prerequisites

Before setting up BYTEWAVE, ensure you have the following installed on your system:

### Required Software

1. **XAMPP** (v8.2.0 or later)
   - Includes Apache, PHP 8.2+, MySQL, and phpMyAdmin
   - Download from: https://www.apachefriends.org/

2. **Composer** (PHP Dependency Manager)
   - Download from: https://getcomposer.org/
   - Required for Laravel and PHP package management

3. **Node.js & npm** (v18.0 or later)
   - Download from: https://nodejs.org/
   - Required for frontend asset compilation

4. **Git** (Version Control)
   - Download from: https://git-scm.com/
   - Required for cloning the repository

### System Requirements

- **Operating System**: Windows 10/11, macOS 10.15+, or Linux
- **RAM**: Minimum 4GB (8GB recommended)
- **Storage**: At least 2GB free space
- **PHP Extensions**: 
  - BCMath
  - Ctype
  - Fileinfo
  - JSON
  - Mbstring
  - OpenSSL
  - PDO
  - Tokenizer
  - XML
  - SQLite3 (for local development)

### Production Requirements

- **Web Server**: Apache 2.4+ or Nginx 1.18+
- **PHP**: 8.2+ with required extensions
- **Database**: MySQL 8.0+ or MariaDB 10.4+
- **SSL Certificate**: Required for production deployment
- **cPanel Access**: For production database management

## 📋 Step-by-Step Installation Guide

### Step 1: Install XAMPP

1. **Download XAMPP**
   - Visit https://www.apachefriends.org/
   - Download XAMPP for your operating system (Windows/macOS/Linux)
   - Choose version 8.2.0 or later for PHP 8.2+ support

2. **Install XAMPP**
   ```bash
   # Windows: Run the downloaded .exe file as administrator
   # macOS: Open the .dmg file and drag XAMPP to Applications
   # Linux: Make the .run file executable and run it
   chmod +x xampp-linux-x64-8.2.0-installer.run
   sudo ./xampp-linux-x64-8.2.0-installer.run
   ```

3. **Start XAMPP Services**
   - Open XAMPP Control Panel
   - Start **Apache** and **MySQL** services
   - Verify services are running (green status)

4. **Verify PHP Installation**
   ```bash
   # Open terminal/command prompt
   php --version
   # Should show PHP 8.2.x or later
   ```

### Step 2: Install Composer

1. **Download and Install Composer**
   ```bash
   # Windows: Download and run Composer-Setup.exe from getcomposer.org
   # macOS/Linux: Run the following commands
   curl -sS https://getcomposer.org/installer | php
   sudo mv composer.phar /usr/local/bin/composer
   ```

2. **Verify Composer Installation**
   ```bash
   composer --version
   # Should show Composer version 2.x
   ```

### Step 3: Install Node.js and npm

1. **Download Node.js**
   - Visit https://nodejs.org/
   - Download LTS version (v18.0 or later)
   - Install using the downloaded installer

2. **Verify Installation**
   ```bash
   node --version
   npm --version
   ```

### Step 4: Clone and Setup Project

1. **Navigate to XAMPP htdocs Directory**
   ```bash
   # Windows
   cd C:\xampp\htdocs
   
   # macOS/Linux
   cd /Applications/XAMPP/htdocs
   ```

2. **Clone the Repository**
   ```bash
   git clone https://github.com/gavinkasaija1/bytewave.git BYTEWAVE
   cd BYTEWAVE
   ```

3. **Install PHP Dependencies**
   ```bash
   composer install
   ```
   
   If you encounter memory issues:
   ```bash
   php -d memory_limit=-1 /usr/local/bin/composer install
   ```

4. **Install Node.js Dependencies**
   ```bash
   npm install
   ```

### Step 5: Environment Configuration

1. **Create Environment File**
   ```bash
   # Copy the example environment file
   cp .env.example .env
   
   # Windows Command Prompt
   copy .env.example .env
   ```

2. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

3. **Configure Environment Variables**
   
   Edit the `.env` file with your preferred text editor:
   
   ```env
   APP_NAME=BYTEWAVE
   APP_ENV=local
   APP_KEY=base64:your-generated-key-here
   APP_DEBUG=true
   APP_URL=http://localhost/BYTEWAVE/public
   
   # Database Configuration (SQLite for local development)
   DB_CONNECTION=sqlite
   # DB_HOST=127.0.0.1
   # DB_PORT=3306
   # DB_DATABASE=bytewave
   # DB_USERNAME=root
   # DB_PASSWORD=
   
   # Production Database Configuration (for syncing)
   PROD_DB_CONNECTION=mysql
   PROD_DB_HOST=your-production-host.com
   PROD_DB_PORT=3306
   PROD_DB_DATABASE=your_production_database
   PROD_DB_USERNAME=your_production_username
   PROD_DB_PASSWORD=your_production_password
   
   # Mail Configuration
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME=your-email@gmail.com
   MAIL_PASSWORD=your-app-password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS=your-email@gmail.com
   MAIL_FROM_NAME="${APP_NAME}"
   ```

### Step 6: Database Setup

1. **Create SQLite Database File**
   ```bash
   # The database file should already exist, but if not:
   touch database/database.sqlite
   
   # Windows
   type nul > database\database.sqlite
   ```

2. **Run Database Migrations**
   ```bash
   php artisan migrate
   ```

3. **Seed the Database**
   ```bash
   php artisan db:seed
   ```
   
   This will create:
   - Test user: `test@example.com`
   - Admin user: `admin@example.com` (password: `password`)
   - Sample data for portfolios, services, products, and blog posts

### Step 7: Storage and Assets Setup

1. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

2. **Build Frontend Assets**
   ```bash
   # For development
   npm run dev
   
   # For production
   npm run build
   ```

### Step 8: Configure Production Database Connection

1. **Add Production Database Configuration**
   
   Edit `config/database.php` and add the production connection:
   
   ```php
   'production' => [
       'driver' => 'mysql',
       'host' => env('PROD_DB_HOST', '127.0.0.1'),
       'port' => env('PROD_DB_PORT', '3306'),
       'database' => env('PROD_DB_DATABASE', 'forge'),
       'username' => env('PROD_DB_USERNAME', 'forge'),
       'password' => env('PROD_DB_PASSWORD', ''),
       'unix_socket' => env('PROD_DB_SOCKET', ''),
       'charset' => 'utf8mb4',
       'collation' => 'utf8mb4_unicode_ci',
       'prefix' => '',
       'prefix_indexes' => true,
       'strict' => true,
       'engine' => null,
       'options' => extension_loaded('pdo_mysql') ? array_filter([
           PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
       ]) : [],
   ],
   ```

## 🔄 Production Database Syncing

BYTEWAVE includes powerful custom Artisan commands for syncing your production MySQL database to your local SQLite development environment.

### Prerequisites for Database Syncing

1. **Production Database Access**
   - Ensure your production database credentials are correct in `.env`
   - Your IP address must be whitelisted in cPanel Remote MySQL settings
   - Production database must be accessible from your development environment

2. **Whitelist Your IP in cPanel**
   - Log into your cPanel hosting account
   - Navigate to **Remote MySQL**
   - Add your current IP address to the access list
   - Save the configuration

### Database Syncing Commands

#### 1. Clone Database Schema

**First-time setup or after schema changes:**

```bash
php artisan db:clone-schema
```

This command:
- Connects to your production MySQL database
- Retrieves all table structures
- Converts MySQL syntax to SQLite-compatible syntax
- Creates tables in your local SQLite database
- Handles data type conversions (INT→INTEGER, VARCHAR→TEXT, etc.)
- Removes MySQL-specific features (foreign keys, indexes, constraints)
- Fixes AUTOINCREMENT syntax for SQLite

#### 2. Sync Production Data

**Regular data synchronization:**

```bash
php artisan db:sync-production
```

This command:
- Connects to production database using `PROD_DB_*` credentials
- Retrieves all data from production tables
- Truncates local tables and inserts fresh production data
- Processes data in chunks (500 records) to avoid memory issues
- Skips tables that don't exist locally
- Provides progress feedback during sync

### Syncing Workflow

1. **Initial Setup** (first time):
   ```bash
   # Clone the database schema from production
   php artisan db:clone-schema
   
   # Sync the data from production
   php artisan db:sync-production
   ```

2. **Regular Updates** (when you need fresh data):
   ```bash
   # Only sync data (schema already exists)
   php artisan db:sync-production
   ```

3. **After Production Schema Changes**:
   ```bash
   # Re-clone schema to get new table structures
   php artisan db:clone-schema
   
   # Sync fresh data
   php artisan db:sync-production
   ```

### Troubleshooting Database Sync

**Common Issues:**

1. **Connection Refused**
   - Check if your IP is whitelisted in cPanel Remote MySQL
   - Verify production database credentials in `.env`
   - Ensure production server allows remote connections

2. **Table Creation Errors**
   - Some complex MySQL features might not convert perfectly
   - Check the error message and manually adjust if needed
   - The conversion function handles most common scenarios

3. **Memory Issues**
   - Large datasets are processed in chunks (500 records)
   - Increase PHP memory limit if needed: `php -d memory_limit=512M artisan db:sync-production`

## 🚀 Running the Application

### Development Server

1. **Start XAMPP Services**
   - Open XAMPP Control Panel
   - Start Apache and MySQL services

2. **Access the Application**
   ```bash
   # Option 1: Use Laravel's built-in server
   php artisan serve
   # Access at: http://localhost:8000
   
   # Option 2: Use XAMPP Apache server
   # Access at: http://localhost/BYTEWAVE/public
   ```

3. **Development with Hot Reload**
   ```bash
   # Run Vite development server for hot reload
   npm run dev
   ```

### Admin Access

After running the seeders, you can access the admin area:

- **Admin URL**: `http://localhost:8000/admin` or `http://localhost/BYTEWAVE/public/admin`
- **Admin Email**: `admin@example.com`
- **Admin Password**: `password`

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 🆘 Support

For support and questions:
- Open an issue on GitHub
- Contact the development team
- Check the documentation

---

**Built with ❤️ using Laravel 12 & Tailwind CSS 4**

*Last updated: October 2025*
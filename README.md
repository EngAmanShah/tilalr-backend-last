# Backend Test - Laravel 12 API Server

A modern Laravel 12 REST API application with authentication, multi-language support, and admin dashboard powered by Filament.

## 📋 Table of Contents
- [Requirements](#requirements)
- [Features](#features)
- [Installation (XAMPP)](#installation-xampp)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [Running the Application](#running-the-application)
- [Project Structure](#project-structure)
- [API Documentation](#api-documentation)
- [Troubleshooting](#troubleshooting)

## ✅ Requirements

- **PHP**: 8.2 or higher
- **MySQL**: 5.7 or higher
- **Composer**: Latest version
- **XAMPP**: (Apache, PHP 8.2+, MySQL included)

### XAMPP Installation
1. Download XAMPP from: https://www.apachefriends.org/download.html
2. Install with PHP 8.2+ and MySQL
3. Start Apache and MySQL from XAMPP Control Panel

### Composer Installation
1. Download from: https://getcomposer.org/download/
2. Run the installer
3. Verify: `composer --version`

## 🚀 Features

- **Laravel 12** - Latest framework version
- **Filament Admin Dashboard** - Beautiful admin UI
- **API Authentication** - Laravel Sanctum
- **Multi-language Support** - Laravel Localization & Translatable
- **Stripe Integration** - Payment processing
- **Email Notifications** - Mail system
- **Queue System** - Background job processing
- **RBAC** - Role-based access control
- **RESTful API** - Full-featured API endpoints

## 💻 Installation (XAMPP)

### Step 1: Prepare Project Directory

```powershell
# Navigate to XAMPP htdocs folder
cd C:\xampp\htdocs

# Clone or copy the project here
# You can keep it at: C:\xampp\htdocs\backend-test
```

### Step 2: Install Dependencies

```powershell
# Navigate to your project
cd C:\xampp\htdocs\backend-test

# Install PHP dependencies
composer install

# Wait for all packages to install (this may take 2-3 minutes)
```

### Step 3: Generate Environment File & Key

```powershell
# Generate .env file from template
php artisan key:generate
```

This will create an `APP_KEY` in your `.env` file automatically.

### Step 4: Start XAMPP Services

1. Open **XAMPP Control Panel**
2. Click **Start** next to:
   - ✅ **Apache**
   - ✅ **MySQL**
3. Wait for both to show green indicators

## ⚙️ Configuration

### .env File Setup

Open `.env` in your editor and update:

```dotenv
# App Configuration
APP_NAME=Laravel
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost/backend-test/public

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test
DB_USERNAME=root
DB_PASSWORD=

# For Stripe (if using)
STRIPE_PUBLIC_KEY=your_key_here
STRIPE_SECRET_KEY=your_secret_here
```

**Note**: Default XAMPP MySQL has no password (root/empty)

## 🗄️ Database Setup

### Create Database

#### Option A: Using Command Line

```powershell
# Run migrations to create tables
php artisan migrate

# (Optional) Seed sample data
php artisan db:seed
```

#### Option B: Using phpMyAdmin

1. Open: http://localhost/phpmyadmin
2. Click **New**
3. Database name: `test`
4. Collation: `utf8mb4_unicode_ci`
5. Click **Create**

Then run migrations:
```powershell
php artisan migrate
```

## ▶️ Running the Application

### Option A: PHP Built-in Server (RECOMMENDED for XAMPP)

```powershell
cd C:\xampp\htdocs\backend-test
php artisan serve
```

- **URL**: http://localhost:8000
- Press `Ctrl + C` to stop

### Option B: Apache via XAMPP

1. Ensure project is in `C:\xampp\htdocs\backend-test`
2. Update `.env`:
   ```dotenv
   APP_URL=http://localhost/backend-test/public
   ```
3. Check permissions on `storage/` and `bootstrap/cache/` folders
4. Visit: http://localhost/backend-test/public

### Access Points

| Purpose | URL |
|---------|-----|
| **API Base** | http://localhost:8000 |
| **Admin Dashboard** | http://localhost:8000/admin |
| **phpMyAdmin** | http://localhost/phpmyadmin |

## 📁 Project Structure

```
backend-test/
├── app/
│   ├── Http/              # Controllers, Middleware, Requests
│   ├── Models/            # Database models
│   ├── Services/          # Business logic services
│   ├── Filament/          # Filament admin resources
│   └── Notifications/     # notification classes
├── config/                # Configuration files
├── database/
│   ├── migrations/        # Database migrations
│   ├── seeders/           # Database seeders
│   └── factories/         # Model factories for testing
├── routes/
│   ├── api.php            # API routes
│   ├── web.php            # Web routes
│   └── console.php        # Console commands
├── resources/
│   ├── views/             # Blade templates
│   ├── css/               # CSS files
│   └── lang/              # Language files
├── storage/               # Application storage (logs, cache)
├── tests/                 # PHPUnit tests
├── public/                # Web server root
├── .env                   # Environment variables (copy from .env.example)
├── artisan                # Laravel CLI
└── composer.json          # Package dependencies
```

## 📡 API Documentation

### Available Routes

Check available endpoints:

```powershell
php artisan route:list
```

### Common API Endpoints

See [routes/api.php](routes/api.php) for complete API documentation.

**Example endpoints** (may vary based on your setup):
- `POST /api/login` - User authentication
- `GET /api/profile` - Get authenticated user
- `GET /api/reservations` - List reservations
- `POST /api/reservations` - Create reservation

## 🛠️ Common Commands

```powershell
# View all artisan commands
php artisan list

# Run migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Seed database
php artisan db:seed

# Create new model
php artisan make:model ModelName -m

# Create new controller
php artisan make:controller ControllerName

# Clear all caches
php artisan cache:clear
php artisan view:clear
php artisan config:clear

# Run tests
php artisan test

# Generate API documentation
php artisan scribe:generate
```

## ❓ Troubleshooting

### Error: "No application encryption key has been specified"
```powershell
php artisan key:generate
```

### Error: "SQLSTATE[HY000]: General error: 1030 Got error"
- MySQL isn't running. Start it from XAMPP Control Panel.

### Error: "Class not found" or "vendor/autoload.php missing"
```powershell
composer install
```

### Port 8000 already in use
```powershell
# Use different port
php artisan serve --port=8001
# Then visit http://localhost:8001
```

### Permission denied on storage folder (Windows)
1. Right-click `storage/` folder → Properties
2. Security → Edit → Select your user
3. Check "Full Control" → Apply

### Database migration fails
1. Verify MySQL is running
2. Check `.env` database credentials
3. Run: `php artisan migrate --step`

### Filament Admin not working
```powershell
php artisan storage:link
php artisan filament:upgrade
```

## 📚 Additional Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Filament Documentation](https://filamentphp.com/docs)
- [Laravel Sanctum](https://laravel.com/docs/sanctum)
- [Composer Documentation](https://getcomposer.org/doc/)

## 📝 Notes

- Keep `.env` file secure - never commit to version control
- Use `.env.example` as a template for new installations
- Check `storage/logs/` for application logs
- For production, set `APP_DEBUG=false` and `APP_ENV=production`

## 🐛 Support

For issues or questions:
1. Check [Troubleshooting](#troubleshooting) section
2. Review Laravel logs: `storage/logs/`
3. Run: `php artisan tinker` for database debugging
4. Check XAMPP error logs in Control Panel

---

**Last Updated**: February 2026  
**Laravel Version**: 12.x  
**PHP Requirement**: 8.2+

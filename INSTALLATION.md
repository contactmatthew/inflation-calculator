# Installation Guide

## Quick Setup (5 minutes)

### Step 1: Database Setup

1. **Open phpMyAdmin** (usually at `http://localhost/phpmyadmin`)

2. **Import the database**:
   - Click on "Import" tab
   - Choose file: `database.sql`
   - Click "Go"

   **OR** run the setup script:
   - Open `http://localhost/Inflation calculator/setup.php` in your browser
   - This will automatically create the database and tables

### Step 2: Configure Database (if needed)

If your MySQL credentials are different, edit `config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // Your MySQL username
define('DB_PASS', '');            // Your MySQL password
define('DB_NAME', 'inflation_calculator');
```

### Step 3: Test the Application

1. Open `http://localhost/Inflation calculator/index.php` in your browser
2. You should see the Inflation Calculator interface
3. Try selecting a country and calculating inflation

## Requirements

- **XAMPP** (or any PHP/MySQL server)
- **PHP 7.4+** (included in XAMPP)
- **MySQL 5.7+** (included in XAMPP)
- **Internet connection** (for API calls)

## Troubleshooting

### Database Connection Error
- Make sure MySQL is running in XAMPP Control Panel
- Check database credentials in `config.php`
- Verify database `inflation_calculator` exists

### API Errors
- Check internet connection
- ExchangeRate-API is free but may have rate limits
- If errors persist, wait a few minutes and try again

### Countries/Currencies Not Loading
- Check browser console for errors (F12)
- Verify `api/get_countries.php` is accessible
- Make sure database tables are created

## File Structure

```
Inflation calculator/
├── index.php              # Main application page
├── config.php             # Database configuration
├── setup.php              # Database setup script
├── database.sql           # Database schema
├── .htaccess              # Apache configuration
├── api/
│   ├── get_countries.php
│   ├── get_currencies.php
│   ├── get_exchange_rate.php
│   ├── get_inflation.php
│   └── calculate_inflation.php
├── README.md
└── INSTALLATION.md
```

## Next Steps

- The application is ready to use!
- All APIs are using free tiers
- For production, consider:
  - Adding API keys for better rate limits
  - Integrating World Bank API for accurate inflation data
  - Adding caching for better performance


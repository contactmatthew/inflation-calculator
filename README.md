# Inflation Calculator

A professional web application for calculating inflation across different countries and currencies.

## Features

- **Country Selection**: Choose from 20+ countries including Philippines
- **Currency Selection**: Calculate in any supported currency
- **Date Selection**: Select custom dates (defaults to today)
- **Auto Currency Change**: Automatically suggests country's currency
- **Real-time Exchange Rates**: Uses ExchangeRate-API for accurate currency conversion
- **Dynamic Inflation Rates**: Automatically fetches and updates inflation rates from real-time API sources
- **Smart Caching**: Inflation data is cached for 7 days and automatically refreshes
- **Professional Design**: Modern UI with Bootstrap and Tailwind CSS

## Technologies Used

- **Frontend**: HTML5, CSS3, JavaScript, Bootstrap 5, Tailwind CSS
- **Backend**: PHP 7.4+
- **Database**: MySQL
- **APIs**: 
  - ExchangeRate-API (free tier) - Currency conversion
  - Statbureau.org Inflation API (free) - Real-time inflation data

## Installation

1. **Setup Database**:
   - Import `database.sql` into your MySQL database
   - Update database credentials in `config.php` if needed

2. **Configure**:
   - Ensure PHP is configured to allow URL file access
   - Make sure the `api` directory is accessible

3. **Access**:
   - Open `index.php` in your web browser
   - The application should be ready to use!

## API Endpoints

- `api/get_countries.php` - Get list of supported countries
- `api/get_currencies.php` - Get list of supported currencies
- `api/get_exchange_rate.php` - Get exchange rate between currencies
- `api/get_inflation.php` - Get inflation rate for a country (auto-updates from API)
- `api/calculate_inflation.php` - Calculate inflation-adjusted value
- `api/refresh_inflation.php` - Force refresh inflation rate for a country

## Usage

1. Select a country from the dropdown
2. Choose the currency you want to calculate in
3. Select the "From Date" (defaults to 1 year ago)
4. Select the "To Date" (defaults to today)
5. Enter the amount
6. Click "Calculate Inflation"

## Dynamic Inflation Updates

The system automatically fetches the latest inflation rates from real-time API sources:
- **Automatic Updates**: Inflation rates are refreshed every 7 days automatically
- **Real-time Data**: When cache expires, fresh data is fetched from Statbureau.org API
- **Fallback System**: If API is unavailable, uses reliable default rates
- **Manual Refresh**: Use `api/refresh_inflation.php?country=XX` to force update

## Notes

- The application uses free APIs that may have rate limits
- Exchange rates are cached in the database for performance
- Inflation rates are automatically updated from real-time sources
- Cache expiry is set to 7 days (configurable in `config.php` as `CACHE_EXPIRY_DAYS`)
- The system will automatically adapt when countries change their inflation rates

## License

Free to use and modify.


# 💰 Inflation Calculator

<div align="center">

![PHP](https://img.shields.io/badge/PHP-7.4+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![License](https://img.shields.io/badge/License-Free-green?style=for-the-badge)

**A professional web application for calculating inflation across different countries and currencies** 🌍

[![GitHub stars](https://img.shields.io/github/stars/contactmatthew/inflation-calculator?style=social)](https://github.com/contactmatthew/inflation-calculator)
[![GitHub forks](https://img.shields.io/github/forks/contactmatthew/inflation-calculator?style=social)](https://github.com/contactmatthew/inflation-calculator)

</div>

---

## ✨ Features

<div style="display: flex; flex-wrap: wrap; gap: 10px;">

- 🌍 **Country Selection**: Choose from **20+ countries** including Philippines
- 💵 **Currency Selection**: Calculate in any supported currency
- 📅 **Date Selection**: Select custom dates (defaults to today)
- 🔄 **Auto Currency Change**: Automatically suggests country's currency
- 💱 **Real-time Exchange Rates**: Uses ExchangeRate-API for accurate currency conversion
- 📊 **Dynamic Inflation Rates**: Automatically fetches and updates inflation rates from real-time API sources
- ⚡ **Smart Caching**: Inflation data is cached for 7 days and automatically refreshes
- 🎨 **Professional Design**: Modern dark mode UI with Bootstrap and Tailwind CSS
- ❤️ **Donation Support**: Floating QR code button for easy donations

</div>

---

## 🛠️ Technologies Used

<table>
<tr>
<td align="center" width="200">
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/html5/html5-original.svg" width="40" height="40"/>
<br/><b>HTML5</b>
</td>
<td align="center" width="200">
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/css3/css3-original.svg" width="40" height="40"/>
<br/><b>CSS3</b>
</td>
<td align="center" width="200">
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" width="40" height="40"/>
<br/><b>JavaScript</b>
</td>
<td align="center" width="200">
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" width="40" height="40"/>
<br/><b>Bootstrap 5</b>
</td>
</tr>
<tr>
<td align="center" width="200">
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" width="40" height="40"/>
<br/><b>PHP 7.4+</b>
</td>
<td align="center" width="200">
<img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" width="40" height="40"/>
<br/><b>MySQL</b>
</td>
<td align="center" width="200">
<img src="https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" width="150"/>
<br/><b>Tailwind CSS</b>
</td>
<td align="center" width="200">
<img src="https://img.shields.io/badge/Font_Awesome-339AF0?style=for-the-badge&logo=fontawesome&logoColor=white" width="150"/>
<br/><b>Font Awesome</b>
</td>
</tr>
</table>

### 🔌 APIs Used

- 🌐 **[ExchangeRate-API](https://www.exchangerate-api.com/)** (free tier) - Currency conversion
- 📈 **[Statbureau.org Inflation API](https://www.statbureau.org/en/inflation-api)** (free) - Real-time inflation data

---

## 🚀 Installation

### Step 1: Setup Database 📊

```bash
# Import the database schema
mysql -u your_username -p your_database < database.sql
```

Or use phpMyAdmin to import `database.sql` into your MySQL database.

### Step 2: Configure ⚙️

Update database credentials in `config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_NAME', 'your_database');
```

### Step 3: Access 🌐

- Open `index.php` in your web browser
- The application should be ready to use! 🎉

---

## 📡 API Endpoints

| Endpoint | Method | Description |
|----------|--------|-------------|
| `api/get_countries.php` | GET | Get list of supported countries |
| `api/get_currencies.php` | GET | Get list of supported currencies |
| `api/get_exchange_rate.php` | GET | Get exchange rate between currencies |
| `api/get_inflation.php` | GET | Get inflation rate for a country (auto-updates from API) |
| `api/calculate_inflation.php` | GET | Calculate inflation-adjusted value |
| `api/refresh_inflation.php` | GET | Force refresh inflation rate for a country |

---

## 📖 Usage

<div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 20px; border-radius: 10px; color: white; margin: 20px 0;">

### 🎯 Quick Start Guide

1. **🌍 Select a country** from the dropdown
2. **💵 Choose the currency** you want to calculate in
3. **📅 Select the "From Date"** (defaults to 1 year ago)
4. **📅 Select the "To Date"** (defaults to today)
5. **💰 Enter the amount**
6. **🚀 Click "Calculate Inflation"**

</div>

---

## 🔄 Dynamic Inflation Updates

<div style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); padding: 20px; border-radius: 10px; color: white; margin: 20px 0;">

The system automatically fetches the latest inflation rates from real-time API sources:

- ✅ **Automatic Updates**: Inflation rates are refreshed every **7 days** automatically
- 🔄 **Real-time Data**: When cache expires, fresh data is fetched from Statbureau.org API
- 🛡️ **Fallback System**: If API is unavailable, uses reliable default rates
- 🔧 **Manual Refresh**: Use `api/refresh_inflation.php?country=XX` to force update

</div>

---

## 📝 Notes

<div style="background: #1e293b; padding: 15px; border-radius: 8px; border-left: 4px solid #3b82f6; margin: 20px 0;">

- ⚠️ The application uses free APIs that may have rate limits
- 💾 Exchange rates are cached in the database for performance
- 📊 Inflation rates are automatically updated from real-time sources
- ⏰ Cache expiry is set to **7 days** (configurable in `config.php` as `CACHE_EXPIRY_DAYS`)
- 🔄 The system will automatically adapt when countries change their inflation rates

</div>

---

## 💝 Support

<div align="center">

**Made with ❤️ by [James Matthew Dela Torre](https://github.com/contactmatthew)**

If you find this project helpful, consider supporting it! 💰

[![Buy Me A Coffee](https://img.shields.io/badge/Buy_Me_A_Coffee-FFDD00?style=for-the-badge&logo=buy-me-a-coffee&logoColor=black)](https://buymeacoffee.com/isshiki)
[![Facebook](https://img.shields.io/badge/Facebook-1877F2?style=for-the-badge&logo=facebook&logoColor=white)](https://www.facebook.com/mtthw28)
[![GitHub](https://img.shields.io/badge/GitHub-181717?style=for-the-badge&logo=github&logoColor=white)](https://github.com/contactmatthew)

</div>

---

## 📄 License

<div align="center">

**Free to use and modify.** 🎉

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](https://opensource.org/licenses/MIT)

</div>

---

<div align="center">

⭐ **Star this repo if you find it useful!** ⭐

</div>

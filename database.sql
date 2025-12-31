CREATE DATABASE IF NOT EXISTS inflation_calculator;
USE inflation_calculator;

CREATE TABLE IF NOT EXISTS countries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(3) UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    currency_code VARCHAR(3) NOT NULL,
    currency_symbol VARCHAR(10) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS exchange_rates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    base_currency VARCHAR(3) NOT NULL,
    target_currency VARCHAR(3) NOT NULL,
    rate DECIMAL(15, 6) NOT NULL,
    date DATE NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_rate (base_currency, target_currency, date)
);

CREATE TABLE IF NOT EXISTS inflation_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    country_code VARCHAR(3) NOT NULL,
    year INT NOT NULL,
    month INT NOT NULL,
    inflation_rate DECIMAL(10, 4) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_inflation (country_code, year, month)
);

INSERT INTO countries (code, name, currency_code, currency_symbol) VALUES
('US', 'United States', 'USD', '$'),
('GB', 'United Kingdom', 'GBP', '£'),
('EU', 'European Union', 'EUR', '€'),
('JP', 'Japan', 'JPY', '¥'),
('CA', 'Canada', 'CAD', 'C$'),
('AU', 'Australia', 'AUD', 'A$'),
('CH', 'Switzerland', 'CHF', 'CHF'),
('CN', 'China', 'CNY', '¥'),
('IN', 'India', 'INR', '₹'),
('BR', 'Brazil', 'BRL', 'R$'),
('MX', 'Mexico', 'MXN', '$'),
('KR', 'South Korea', 'KRW', '₩'),
('SG', 'Singapore', 'SGD', 'S$'),
('NZ', 'New Zealand', 'NZD', 'NZ$'),
('ZA', 'South Africa', 'ZAR', 'R'),
('SE', 'Sweden', 'SEK', 'kr'),
('NO', 'Norway', 'NOK', 'kr'),
('DK', 'Denmark', 'DKK', 'kr'),
('PL', 'Poland', 'PLN', 'zł'),
('TR', 'Turkey', 'TRY', '₺'),
('PH', 'Philippines', 'PHP', '₱')
ON DUPLICATE KEY UPDATE name=VALUES(name);


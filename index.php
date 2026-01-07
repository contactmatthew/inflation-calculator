<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inflation Calculator - Calculate Inflation Across Countries</title>
    
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="shortcut icon" type="image/png" href="favicon.png">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --text-primary: #f1f5f9;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            --accent-primary: #3b82f6;
            --accent-hover: #2563eb;
            --border-color: #334155;
            --success-color: #10b981;
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.2);
        }
        
        * {
            transition: background-color 0.2s ease, color 0.2s ease, border-color 0.2s ease;
        }
        
        body {
            background-color: var(--bg-primary);
            min-height: 100vh;
            font-family: 'Inter', 'Segoe UI', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--text-primary);
            padding-top: 0;
            padding-bottom: 2rem;
        }
        
        .header-title {
            color: var(--text-primary);
            text-align: center;
            padding: 2.5rem 0 1.5rem;
            font-size: 2.75rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: 1rem;
        }
        
        .header-subtitle {
            text-align: center;
            color: var(--text-muted);
            font-size: 1.1rem;
            margin-bottom: 3rem;
            font-weight: 400;
        }
        
        .calculator-card {
            background-color: var(--bg-secondary);
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            padding: 2.5rem;
            margin-top: 1rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
        }
        
        .result-card {
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
            border-radius: 16px;
            padding: 2rem;
            margin-top: 2rem;
            display: none;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }
        
        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .form-label i {
            color: var(--accent-primary);
            width: 18px;
        }
        
        .btn-calculate {
            background-color: var(--accent-primary);
            border: none;
            padding: 14px 32px;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-size: 1rem;
            letter-spacing: 0.01em;
        }
        
        .btn-calculate:hover {
            background-color: var(--accent-hover);
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(59, 130, 246, 0.3);
        }
        
        .btn-calculate:active {
            transform: translateY(0);
        }
        
        .form-control, .form-select {
            background-color: var(--bg-tertiary);
            border: 1px solid var(--border-color);
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            color: var(--text-primary);
            font-size: 0.95rem;
        }
        
        .form-control:focus, .form-select:focus {
            background-color: var(--bg-tertiary);
            border-color: var(--accent-primary);
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            color: var(--text-primary);
            outline: none;
        }
        
        .form-control::placeholder {
            color: var(--text-muted);
        }
        
        .form-select option {
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
        }
        
        .input-group-text {
            background-color: var(--bg-tertiary);
            border: 1px solid var(--border-color);
            color: var(--text-secondary);
            border-right: none;
            border-radius: 10px 0 0 10px;
            padding: 12px 16px;
            font-weight: 600;
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        
        .input-group .form-control:focus {
            border-left: 1px solid var(--accent-primary);
        }
        
        .info-icon {
            color: var(--text-muted);
            margin-left: 4px;
            cursor: help;
            font-size: 0.85rem;
        }
        
        .info-icon:hover {
            color: var(--accent-primary);
        }
        
        .result-card h3 {
            color: var(--text-primary);
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }
        
        .result-card h5 {
            color: var(--text-secondary);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
        }
        
        .result-card h6 {
            color: var(--text-muted);
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .result-card .h4 {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1.75rem;
        }
        
        .result-card .h5 {
            color: var(--accent-primary);
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .text-success {
            color: var(--success-color) !important;
        }
        
        .result-card small {
            color: var(--text-secondary);
            font-size: 0.85rem;
        }
        
        .result-card small i {
            color: var(--accent-primary);
        }
        
        .result-card hr {
            border-color: var(--border-color);
            margin: 1.5rem 0;
            opacity: 0.5;
        }
        
        .alert {
            border-radius: 10px;
            border: 1px solid var(--border-color);
        }
        
        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }
        
        @media (max-width: 768px) {
            .calculator-card {
                padding: 1.5rem;
            }
            
            .header-title {
                font-size: 2rem;
                padding: 1.5rem 0 1rem;
            }
            
            .header-subtitle {
                font-size: 0.95rem;
                margin-bottom: 2rem;
            }
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        ::selection {
            background-color: var(--accent-primary);
            color: white;
        }
        
        /* About Section */
        .about-section {
            margin-top: 4rem;
            padding: 3rem 0;
        }
        
        .about-card {
            background-color: var(--bg-secondary);
            border-radius: 16px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--border-color);
            box-shadow: var(--card-shadow);
        }
        
        .about-card h2 {
            color: var(--text-primary);
            font-weight: 700;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .about-card h2 i {
            color: var(--accent-primary);
        }
        
        .about-card h3 {
            color: var(--text-primary);
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }
        
        .about-card p {
            color: var(--text-secondary);
            line-height: 1.8;
            margin-bottom: 1rem;
        }
        
        .about-card ul {
            color: var(--text-secondary);
            line-height: 2;
            padding-left: 1.5rem;
        }
        
        .about-card ul li {
            margin-bottom: 0.5rem;
        }
        
        .about-card ul li i {
            color: var(--accent-primary);
            margin-right: 0.5rem;
        }
        
        .tech-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-top: 1rem;
        }
        
        .tech-badge {
            background-color: var(--bg-tertiary);
            color: var(--text-primary);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            font-size: 0.9rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .tech-badge i {
            color: var(--accent-primary);
        }
        
        .footer {
            margin-top: 4rem;
            padding: 2rem 0;
            text-align: center;
            border-top: 1px solid var(--border-color);
        }
        
        .footer-content {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }
        
        .social-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
            text-decoration: none;
            padding: 0.75rem 1.25rem;
            border-radius: 10px;
            border: 1px solid var(--border-color);
            background-color: var(--bg-secondary);
            transition: all 0.3s ease;
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .social-link:hover {
            color: var(--text-primary);
            background-color: var(--bg-tertiary);
            border-color: var(--accent-primary);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
        }
        
        .social-link i {
            font-size: 1.1rem;
        }
        
        .social-link.buy-coffee {
            background-color: #FFDD00;
            color: #0f172a;
            border-color: #FFDD00;
            font-weight: 600;
        }
        
        .social-link.buy-coffee:hover {
            background-color: #FFE033;
            color: #0f172a;
            border-color: #FFE033;
            box-shadow: 0 4px 12px rgba(255, 221, 0, 0.4);
        }
        
        .social-link.facebook:hover {
            color: #1877F2;
            border-color: #1877F2;
        }
        
        .social-link.github:hover {
            color: #ffffff;
            border-color: #ffffff;
        }
        
        /* Navbar Styles */
        .navbar {
            background-color: var(--bg-secondary);
            border-bottom: 1px solid var(--border-color);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .navbar-brand {
            color: var(--text-primary);
            font-weight: 700;
            font-size: 1.5rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.3s ease;
        }
        
        .navbar-brand:hover {
            color: var(--accent-primary);
        }
        
        .navbar-brand i {
            color: var(--accent-primary);
        }
        
        .navbar-nav {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 0.5rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .navbar-nav li {
            display: inline-block;
        }
        
        .nav-link {
            color: var(--text-secondary);
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }
        
        .nav-link:hover {
            color: var(--text-primary);
            background-color: var(--bg-tertiary);
            transform: translateY(-2px);
        }
        
        .nav-link i {
            font-size: 1rem;
        }
        
        .navbar-toggler {
            background-color: var(--bg-tertiary);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            display: none;
            cursor: pointer;
        }
        
        .navbar-collapse {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }
        
        @media (max-width: 768px) {
            .navbar-toggler {
                display: block;
            }
            
            .navbar-collapse {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .navbar-nav {
                flex-direction: column;
                width: 100%;
                margin-top: 1rem;
                display: none;
                gap: 0.5rem;
            }
            
            .navbar-nav.show {
                display: flex;
            }
            
            .navbar-nav li {
                width: 100%;
            }
            
            .nav-link {
                width: 100%;
                justify-content: flex-start;
            }
        }
        
        /* Floating QR Code Button */
        .floating-qr-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 20px rgba(239, 68, 68, 0.4);
            cursor: pointer;
            z-index: 1000;
            transition: all 0.3s ease;
            border: none;
            color: white;
            font-size: 1.5rem;
        }
        
        .floating-qr-button:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 8px 30px rgba(239, 68, 68, 0.6);
            background: linear-gradient(135deg, #f87171, #ef4444);
        }
        
        .floating-qr-button:active {
            transform: translateY(-2px) scale(1.05);
        }
        
        @media (max-width: 768px) {
            .floating-qr-button {
                bottom: 20px;
                right: 20px;
                width: 55px;
                height: 55px;
                font-size: 1.3rem;
            }
        }
        
        /* Donation Modal Styles */
        .donation-modal {
            background-color: var(--bg-secondary);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
        }
        
        .donation-modal .modal-header {
            border-bottom: 1px solid var(--border-color);
            background-color: var(--bg-tertiary);
        }
        
        .donation-modal .modal-title {
            color: var(--text-primary);
            font-weight: 600;
        }
        
        .donation-modal .btn-close-white {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
        
        .donation-modal .modal-body {
            background-color: var(--bg-secondary);
        }
        
        .thank-you-message {
            margin-bottom: 1.5rem;
        }
        
        .thank-you-icon {
            font-size: 3rem;
            color: #ef4444;
            margin-bottom: 0.5rem;
            animation: heartbeat 1.5s ease-in-out infinite;
        }
        
        @keyframes heartbeat {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }
        
        .thank-you-text {
            color: var(--text-primary);
            font-weight: 600;
            margin-top: 0.5rem;
        }
        
        .qr-code-container {
            display: inline-block;
            padding: 1rem;
            background-color: white;
            border-radius: 12px;
            margin: 1rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }
        
        .qr-code-image {
            max-width: 250px;
            height: auto;
            display: block;
        }
        
        @media (max-width: 576px) {
            .qr-code-image {
                max-width: 200px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <div class="navbar-collapse">
                <a class="navbar-brand" href="#">
                    <i class="fas fa-calculator"></i>
                    Inflation Calculator
                </a>
                <button class="navbar-toggler" type="button" onclick="toggleNavbar()">
                    <i class="fas fa-bars"></i>
                </button>
                <ul class="navbar-nav" id="navbarNav">
                    <li>
                        <a class="nav-link" href="#calculator">
                            <i class="fas fa-calculator"></i>
                            Calculator
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#about">
                            <i class="fas fa-info-circle"></i>
                            About
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="https://github.com/contactmatthew/inflation-calculator" target="_blank" rel="noopener noreferrer">
                            <i class="fab fa-github"></i>
                            GitHub
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="https://buymeacoffee.com/isshiki" target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-coffee"></i>
                            Buy Coffee
                        </a>
                    </li>
                    <li>
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#donationModal">
                            <i class="bi bi-heart-fill"></i>
                            Donate
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container" id="calculator">
        <h1 class="header-title">
            <i class="fas fa-calculator"></i> Inflation Calculator
        </h1>
        <p class="header-subtitle">Calculate inflation-adjusted values across countries and currencies</p>
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="calculator-card">
                    <form id="inflationForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-globe"></i> Select Country
                                    <i class="fas fa-info-circle info-icon" title="Select the country for inflation calculation"></i>
                                </label>
                                <select class="form-select" id="countrySelect" required>
                                    <option value="">Loading countries...</option>
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-coins"></i> Currency to Calculate
                                    <i class="fas fa-info-circle info-icon" title="Choose the currency for your calculation"></i>
                                </label>
                                <select class="form-select" id="currencySelect" required>
                                    <option value="">Loading currencies...</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt"></i> From Date
                                    <i class="fas fa-info-circle info-icon" title="Select the starting date for calculation"></i>
                                </label>
                                <input type="date" class="form-control" id="fromDate" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    <i class="fas fa-calendar-check"></i> To Date (Default: Today)
                                    <i class="fas fa-info-circle info-icon" title="Select the end date (defaults to today)"></i>
                                </label>
                                <input type="date" class="form-control" id="toDate" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="fas fa-dollar-sign"></i> Amount
                                <i class="fas fa-info-circle info-icon" title="Enter the amount to calculate"></i>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text" id="currencySymbol">$</span>
                                <input type="number" class="form-control" id="amount" step="0.01" min="0" placeholder="Enter amount" required>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-calculate">
                                <i class="fas fa-calculator"></i> Calculate Inflation
                            </button>
                        </div>
                    </form>
                    
                    <div class="result-card" id="resultCard">
                        <h3><i class="fas fa-chart-line"></i> Calculation Result</h3>
                        <div id="resultContent"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- About Section -->
        <div class="about-section" id="about">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="about-card">
                            <h2>
                                <i class="fas fa-info-circle"></i>
                                About Inflation Calculator
                            </h2>
                            
                            <p>
                                The <strong>Inflation Calculator</strong> is a professional web application designed to help you understand how inflation affects the purchasing power of money across different countries and currencies. Whether you're planning investments, comparing costs, or simply curious about economic trends, this tool provides accurate, real-time calculations.
                            </p>
                            
                            <h3><i class="fas fa-star"></i> Key Features</h3>
                            <ul>
                                <li><i class="fas fa-check-circle"></i> <strong>Multi-Country Support:</strong> Calculate inflation for 20+ countries including the Philippines, United States, United Kingdom, and more</li>
                                <li><i class="fas fa-check-circle"></i> <strong>Currency Flexibility:</strong> Calculate in any supported currency with automatic exchange rate conversion</li>
                                <li><i class="fas fa-check-circle"></i> <strong>Real-Time Data:</strong> Automatically fetches the latest inflation rates from reliable API sources</li>
                                <li><i class="fas fa-check-circle"></i> <strong>Smart Caching:</strong> Optimized performance with intelligent data caching (7-day refresh cycle)</li>
                                <li><i class="fas fa-check-circle"></i> <strong>User-Friendly Interface:</strong> Modern dark mode design with intuitive controls</li>
                                <li><i class="fas fa-check-circle"></i> <strong>Accurate Calculations:</strong> Uses official inflation data and real-time exchange rates</li>
                            </ul>
                            
                            <h3><i class="fas fa-cogs"></i> How It Works</h3>
                            <p>
                                The calculator uses historical inflation data to determine how much a specific amount of money from a past date would be worth today. It combines:
                            </p>
                            <ul>
                                <li><i class="fas fa-chart-line"></i> Monthly inflation rates for the selected country</li>
                                <li><i class="fas fa-exchange-alt"></i> Real-time currency exchange rates</li>
                                <li><i class="fas fa-calculator"></i> Compound inflation calculations over the selected time period</li>
                            </ul>
                            
                            <h3><i class="fas fa-code"></i> Technologies Used</h3>
                            <div class="tech-badges">
                                <span class="tech-badge"><i class="fab fa-html5"></i> HTML5</span>
                                <span class="tech-badge"><i class="fab fa-css3-alt"></i> CSS3</span>
                                <span class="tech-badge"><i class="fab fa-js"></i> JavaScript</span>
                                <span class="tech-badge"><i class="fab fa-php"></i> PHP 7.4+</span>
                                <span class="tech-badge"><i class="fas fa-database"></i> MySQL</span>
                                <span class="tech-badge"><i class="fab fa-bootstrap"></i> Bootstrap 5</span>
                                <span class="tech-badge"><i class="fas fa-wind"></i> Tailwind CSS</span>
                                <span class="tech-badge"><i class="fab fa-font-awesome"></i> Font Awesome</span>
                            </div>
                            
                            <h3><i class="fas fa-database"></i> Data Sources</h3>
                            <ul>
                                <li><i class="fas fa-globe"></i> <strong>ExchangeRate-API:</strong> Real-time currency exchange rates</li>
                                <li><i class="fas fa-chart-bar"></i> <strong>Statbureau.org:</strong> Official inflation rate data</li>
                            </ul>
                            
                            <h3><i class="fas fa-user"></i> About the Developer</h3>
                            <p>
                                Made with <i class="fas fa-heart" style="color: #ef4444;"></i> by <strong>James Matthew Dela Torre</strong>
                            </p>
                            <p>
                                This project is open-source and free to use. If you find it helpful, consider supporting the development through donations or by starring the project on GitHub!
                            </p>
                            
                            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--border-color);">
                                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0;">
                                    <i class="fas fa-info-circle" style="color: var(--accent-primary);"></i>
                                    <strong>Note:</strong> Inflation rates are automatically updated weekly. Exchange rates are cached for performance and updated as needed. All calculations are estimates based on available data.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <footer class="footer">
            <div class="container">
                <div class="footer-content">
                    <p>Made with <i class="fas fa-heart" style="color: #ef4444;"></i> by James Matthew Dela Torre</p>
                </div>
                <div class="social-links">
                    <a href="https://buymeacoffee.com/isshiki" target="_blank" rel="noopener noreferrer" class="social-link buy-coffee">
                        <i class="fas fa-coffee"></i>
                        <span>Buy Me a Coffee</span>
                    </a>
                    <a href="https://www.facebook.com/mtthw28" target="_blank" rel="noopener noreferrer" class="social-link facebook">
                        <i class="fab fa-facebook-f"></i>
                        <span>Facebook</span>
                    </a>
                    <a href="https://github.com/contactmatthew" target="_blank" rel="noopener noreferrer" class="social-link github">
                        <i class="fab fa-github"></i>
                        <span>GitHub</span>
                    </a>
                </div>
            </div>
        </footer>
    </div>
    
    <!-- Floating QR Code Button -->
    <button type="button" class="floating-qr-button" data-bs-toggle="modal" data-bs-target="#donationModal" aria-label="Donate">
        <i class="bi bi-heart-fill"></i>
    </button>
    
    <!-- Donation Modal -->
    <div class="modal fade" id="donationModal" tabindex="-1" aria-labelledby="donationModalLabel" aria-hidden="true" data-bs-backdrop="true" data-bs-keyboard="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content donation-modal">
                <div class="modal-header">
                    <h5 class="modal-title" id="donationModalLabel">
                        <i class="bi bi-heart-fill text-danger"></i> Support Inflation Calculator
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div class="thank-you-message">
                        <i class="bi bi-heart-fill thank-you-icon"></i>
                        <h4 class="thank-you-text">Thank You!</h4>
                    </div>
                    <p class="mb-2 small">Scan the QR code to make a donation</p>
                    <div class="qr-code-container">
                        <img src="donate.jpg" alt="Donation QR Code" class="qr-code-image">
                    </div>
                    <p class="mt-2 mb-0 text-muted small">Your support helps keep Inflation Calculator running!</p>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Navbar toggle function for mobile
        function toggleNavbar() {
            const navbarNav = document.getElementById('navbarNav');
            navbarNav.classList.toggle('show');
        }
        
        // Close navbar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const navbar = document.querySelector('.navbar');
            const navbarNav = document.getElementById('navbarNav');
            
            if (window.innerWidth <= 768) {
                if (!navbar.contains(event.target) && navbarNav.classList.contains('show')) {
                    navbarNav.classList.remove('show');
                }
            }
        });
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '#donationModal') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        // Close mobile menu if open
                        const navbarNav = document.getElementById('navbarNav');
                        if (navbarNav.classList.contains('show')) {
                            navbarNav.classList.remove('show');
                        }
                    }
                }
            });
        });
        
        document.getElementById('toDate').valueAsDate = new Date();
        const oneYearAgo = new Date();
        oneYearAgo.setFullYear(oneYearAgo.getFullYear() - 1);
        document.getElementById('fromDate').valueAsDate = oneYearAgo;
        
        fetch('api/get_countries.php')
            .then(response => response.json())
            .then(data => {
                const countrySelect = document.getElementById('countrySelect');
                countrySelect.innerHTML = '<option value="">Select a country</option>';
                data.forEach(country => {
                    const option = document.createElement('option');
                    option.value = country.code;
                    option.textContent = `${country.name} (${country.currency_code})`;
                    option.dataset.currency = country.currency_code;
                    option.dataset.symbol = country.currency_symbol;
                    countrySelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error loading countries:', error);
                document.getElementById('countrySelect').innerHTML = '<option value="">Error loading countries</option>';
            });
        
        fetch('api/get_currencies.php')
            .then(response => response.json())
            .then(data => {
                const currencySelect = document.getElementById('currencySelect');
                currencySelect.innerHTML = '<option value="">Select a currency</option>';
                data.forEach(currency => {
                    const option = document.createElement('option');
                    option.value = currency.currency_code;
                    option.textContent = `${currency.currency_code} (${currency.currency_symbol})`;
                    currencySelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error loading currencies:', error);
                document.getElementById('currencySelect').innerHTML = '<option value="">Error loading currencies</option>';
            });
        
        document.getElementById('currencySelect').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const symbol = selectedOption.textContent.match(/\(([^)]+)\)/)?.[1] || '$';
            document.getElementById('currencySymbol').textContent = symbol;
        });
        
        document.getElementById('countrySelect').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            if (selectedOption.value) {
                const currencyCode = selectedOption.dataset.currency;
                const currencySelect = document.getElementById('currencySelect');
                
                for (let option of currencySelect.options) {
                    if (option.value === currencyCode) {
                        currencySelect.value = currencyCode;
                        const symbol = option.textContent.match(/\(([^)]+)\)/)?.[1] || '$';
                        document.getElementById('currencySymbol').textContent = symbol;
                        break;
                    }
                }
            }
        });
        
        document.getElementById('inflationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const amount = document.getElementById('amount').value;
            const country = document.getElementById('countrySelect').value;
            const currency = document.getElementById('currencySelect').value;
            const fromDate = document.getElementById('fromDate').value;
            const toDate = document.getElementById('toDate').value;
            
            if (!amount || !country || !currency || !fromDate || !toDate) {
                alert('Please fill in all fields');
                return;
            }
            
            if (new Date(fromDate) > new Date(toDate)) {
                alert('From date cannot be after To date');
                return;
            }
            
            const resultCard = document.getElementById('resultCard');
            const resultContent = document.getElementById('resultContent');
            resultCard.style.display = 'block';
            resultContent.innerHTML = '<div class="text-center" style="padding: 2rem 0;"><i class="fas fa-spinner fa-spin fa-2x" style="color: var(--accent-primary);"></i><p class="mt-3" style="color: var(--text-secondary);">Calculating inflation...</p></div>';
            
            const url = `api/calculate_inflation.php?amount=${encodeURIComponent(amount)}&country=${encodeURIComponent(country)}&currency=${encodeURIComponent(currency)}&from_date=${encodeURIComponent(fromDate)}&to_date=${encodeURIComponent(toDate)}`;
            
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.error) {
                        resultContent.innerHTML = `<div class="alert alert-danger mb-0"><i class="fas fa-exclamation-triangle"></i> ${data.error}</div>`;
                        return;
                    }
                    
                    const difference = data.adjusted_amount - data.original_amount;
                    const differenceClass = difference >= 0 ? 'text-success' : '';
                    const differenceIcon = difference >= 0 ? 'fa-arrow-up' : 'fa-arrow-down';
                    
                    const resultContent = `
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <h5><i class="fas fa-coins"></i> Original Amount</h5>
                                <p class="h4 mb-2">${data.original_amount.toLocaleString()} ${data.original_currency}</p>
                                <small><i class="fas fa-calendar"></i> ${new Date(data.from_date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</small>
                            </div>
                            <div class="col-md-6 mb-4">
                                <h5><i class="fas fa-chart-line"></i> Adjusted Amount</h5>
                                <p class="h4 mb-2">${data.adjusted_amount.toLocaleString()} ${data.adjusted_currency}</p>
                                <small><i class="fas fa-calendar"></i> ${new Date(data.to_date).toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' })}</small>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <h6>Inflation Rate</h6>
                                <p class="h5">${data.inflation_rate.toFixed(2)}%</p>
                                <small><i class="fas fa-sync-alt"></i> Auto-updated</small>
                            </div>
                            <div class="col-md-4 mb-3">
                                <h6>Time Period</h6>
                                <p class="h5">${data.months_diff} ${data.months_diff === 1 ? 'month' : 'months'}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <h6>Difference</h6>
                                <p class="h5 ${differenceClass}"><i class="fas ${differenceIcon}"></i> ${Math.abs(difference).toFixed(2)} ${data.adjusted_currency}</p>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-top" style="border-color: var(--border-color) !important;">
                            <small style="color: var(--text-secondary);"><i class="fas fa-info-circle" style="color: var(--accent-primary);"></i> Inflation rates are automatically updated weekly from real-time data sources</small>
                        </div>
                    `;
                    
                    document.getElementById('resultContent').innerHTML = resultContent;
                })
                .catch(error => {
                    console.error('Error:', error);
                    resultContent.innerHTML = '<div class="alert alert-danger mb-0"><i class="fas fa-exclamation-triangle"></i> Failed to calculate. Please check your connection and try again.</div>';
                });
        });
    </script>
</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Dream Home</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: white;
        }
        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background: rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
        }
        .logo {
            color: white;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 2px;
        }
        .nav-links {
            display: flex;
            gap: 30px;
            list-style: none;
        }
        .nav-links a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            font-size: 14px;
        }
        .hero-header {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.2) 100%), url('/images/photo2.jpg') center/cover no-repeat;
            background-size: cover;
            min-height: 200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 80px 20px 20px;
        }
        .hero-header h1 {
            font-size: 48px;
            font-weight: 700;
            letter-spacing: 2px;
            max-width: 800px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
        }
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-bottom: 60px;
        }
        .service-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .service-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
            transform: translateY(-5px);
        }
        .service-icon {
            width: 60px;
            height: 60px;
            margin: 0 auto 20px;
            background: #f0f0f0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
        }
        .service-title {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin-bottom: 10px;
        }
        .service-description {
            font-size: 13px;
            color: #666;
            line-height: 1.6;
        }
        .cta-section {
            display: flex;
            gap: 30px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 60px;
        }
        .cta-btn {
            padding: 14px 40px;
            font-size: 14px;
            font-weight: 600;
            border: 2px solid #333;
            border-radius: 8px;
            background: white;
            color: #333;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .cta-btn.primary {
            background: #5B9DB5;
            color: white;
            border-color: #5B9DB5;
        }
        .cta-btn.secondary {
            background: #8B9D6F;
            color: white;
            border-color: #8B9D6F;
        }
        .cta-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
    </style>
</head>
<body>
    <nav class="nav">
        <div class="logo">DREAM HOME</div>
        <ul class="nav-links">
            <li><a href="{{ route('welcome') }}">Home</a></li>
            <li><a href="{{ route('find-home') }}">Find a Home</a></li>
            <li><a href="{{ route('list-property') }}">List Your Property</a></li>
            <li><a href="{{ route('services') }}">Services</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('contact') }}">Contact</a></li>
            @auth
                <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
            @else
                <li><a href="{{ route('login') }}">Log In</a></li>
            @endauth
        </ul>
    </nav>

    <div class="hero-header">
        <h1>Unlock your real estate success. Explore our comprehensive services.</h1>
    </div>

    <div class="container">
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">🏢</div>
                <div class="service-title">Strategic Services for Landlords</div>
                <div class="service-description">Comprehensive property management solutions designed to maximize your rental income and property value.</div>
            </div>

            <div class="service-card">
                <div class="service-icon">🏠</div>
                <div class="service-title">Elevated Services for Tenants</div>
                <div class="service-description">Premium tenant experience with dedicated support and property options that match your lifestyle.</div>
            </div>

            <div class="service-card">
                <div class="service-icon">🔗</div>
                <div class="service-title">Specialized Real Estate Portals</div>
                <div class="service-description">Exclusive online portals providing seamless access to property information and tenant management tools.</div>
            </div>

            <div class="service-card">
                <div class="service-icon">👥</div>
                <div class="service-title">Tenant Placement & Screening</div>
                <div class="service-description">Rigorous tenant verification process ensuring reliable and trustworthy residents for your properties.</div>
            </div>

            <div class="service-card">
                <div class="service-icon">🔍</div>
                <div class="service-title">Advanced Property Search & Filtering</div>
                <div class="service-description">Intelligent search tools helping renters find their perfect home with precise filtering options.</div>
            </div>

            <div class="service-card">
                <div class="service-icon">📱</div>
                <div class="service-title">Enhanced Landlord Ports</div>
                <div class="service-description">Modern dashboard for managing properties, tenants, and financial reports all in one place.</div>
            </div>

            <div class="service-card">
                <div class="service-icon">🔧</div>
                <div class="service-title">Premium Property Management</div>
                <div class="service-description">Full-service maintenance and property upkeep to ensure your rental properties remain in pristine condition.</div>
            </div>

            <div class="service-card">
                <div class="service-icon">🗓️</div>
                <div class="service-title">Personalized Tour Scheduling</div>
                <div class="service-description">Convenient scheduling system for property tours and viewings tailored to your availability.</div>
            </div>

            <div class="service-card">
                <div class="service-icon">📊</div>
                <div class="service-title">Market Analysis & Strategic Pricing</div>
                <div class="service-description">Data-driven insights to help set competitive rental prices and maximize market positioning.</div>
            </div>

            <div class="service-card">
                <div class="service-icon">✅</div>
                <div class="service-title">Streamlined Online Application Process</div>
                <div class="service-description">Simple and efficient rental application system that saves time for both landlords and tenants.</div>
            </div>

            <div class="service-card">
                <div class="service-icon">⚖️</div>
                <div class="service-title">Legal Compliance & Risk Mitigation</div>
                <div class="service-description">Expert guidance on rental laws and compliance to protect your property investment and interests.</div>
            </div>

            <div class="service-card">
                <div class="service-icon">💳</div>
                <div class="service-title">Secure Tenant Portal & Easy Rent Payments</div>
                <div class="service-description">Secure online platform for tenants to manage rent payments and communication with landlords.</div>
            </div>

            <div class="service-card">
                <div class="service-icon">📈</div>
                <div class="service-title">Landlord Portal Benefits & Performance Reporting</div>
                <div class="service-description">Comprehensive performance analytics and reporting tools for tracking property metrics and growth.</div>
            </div>

            <div class="service-card">
                <div class="service-icon">☎️</div>
                <div class="service-title">24/7 Tenant Support & Maintenance Requests</div>
                <div class="service-description">Round-the-clock customer support and quick response system for all tenant maintenance needs.</div>
            </div>
        </div>

        <div class="cta-section">
            <button class="cta-btn secondary">Partner with Us</button>
            <button class="cta-btn primary">Find Your Next Home</button>
        </div>
    </div>
</body>
</html>

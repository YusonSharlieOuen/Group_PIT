<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find a Home - Dream Home</title>
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
            min-height: 150px;
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
        }
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .search-section {
            margin-bottom: 40px;
        }
        .search-bar {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .search-input {
            flex: 1;
            min-width: 250px;
            padding: 12px 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
        }
        .filter-select {
            padding: 12px 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background: white;
            font-size: 14px;
            cursor: pointer;
        }
        .search-btn {
            padding: 12px 30px;
            background: #8B9D6F;
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
        }
        .search-btn:hover {
            background: #7a8860;
        }
        .results-container {
            display: flex;
            gap: 30px;
        }
        .properties-grid {
            flex: 1;
        }
        .properties {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
        }
        .property-card {
            background: white;
            border: 1px solid #eee;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: box-shadow 0.3s ease;
        }
        .property-card:hover {
            box-shadow: 0 4px 16px rgba(0,0,0,0.15);
        }
        .property-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .property-details {
            padding: 15px;
        }
        .property-address {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        .property-price {
            font-size: 18px;
            font-weight: 700;
            color: #333;
            margin-bottom: 5px;
        }
        .property-specs {
            font-size: 12px;
            color: #666;
            margin-bottom: 15px;
        }
        .property-description {
            font-size: 13px;
            color: #888;
            margin-bottom: 15px;
            line-height: 1.4;
        }
        .property-actions {
            display: flex;
            gap: 10px;
        }
        .btn-save {
            flex: 1;
            padding: 8px 12px;
            background: #e8e8e8;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
        }
        .btn-view {
            flex: 1;
            padding: 8px 12px;
            background: #5B9DB5;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
        }
        .map-container {
            width: 350px;
            height: 600px;
            background: #f0f0f0;
            border-radius: 12px;
            border: 1px solid #ddd;
        }
        @media (max-width: 1024px) {
            .results-container {
                flex-direction: column;
            }
            .map-container {
                width: 100%;
                height: 400px;
            }
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
        <h1>FIND YOUR DREAM HOME</h1>
    </div>

    <div class="container">
        <div class="search-section">
            <div class="search-bar">
                <input type="text" class="search-input" placeholder="Enter City, Neighborhood, or Zip Code">
                <select class="filter-select">
                    <option>Property Type</option>
                    <option>House</option>
                    <option>Condo</option>
                    <option>Apartment</option>
                </select>
                <select class="filter-select">
                    <option>Price Range</option>
                    <option>Under ₱30,000</option>
                    <option>₱30,000 - ₱50,000</option>
                    <option>₱50,000+</option>
                </select>
                <select class="filter-select">
                    <option>Beds/Baths</option>
                    <option>1 Bed</option>
                    <option>2 Beds</option>
                    <option>3+ Beds</option>
                </select>
                <select class="filter-select">
                    <option>Square Feet</option>
                    <option>Under 1000</option>
                    <option>1000 - 2000</option>
                    <option>2000+</option>
                </select>
                <button class="search-btn">Search</button>
            </div>
        </div>

        <div class="results-container">
            <div class="properties-grid">
                <div class="properties">
                    <div class="property-card">
                        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=400&q=80" alt="Property" class="property-image">
                        <div class="property-details">
                            <div class="property-address">Address Villa, Miamian</div>
                            <div class="property-price">₱850,000</div>
                            <div class="property-specs">3 Bd, 2 Ba</div>
                            <div class="property-description">A magnum dolor sit amet, consectetur and oriented in the bacchend with completed home.</div>
                            <div class="property-actions">
                                <button class="btn-save">Save Property</button>
                                <button class="btn-view">View Details</button>
                            </div>
                        </div>
                    </div>

                    <div class="property-card">
                        <img src="https://images.unsplash.com/photo-1580587771525-78991c1a2c14?auto=format&fit=crop&w=400&q=80" alt="Property" class="property-image">
                        <div class="property-details">
                            <div class="property-address">Address Brick home</div>
                            <div class="property-price">₱750,000</div>
                            <div class="property-specs">3 Bd, 2 Ba</div>
                            <div class="property-description">Traditional consolidated and convenient homesite for a prime home suitable.</div>
                            <div class="property-actions">
                                <button class="btn-save">Save Property</button>
                                <button class="btn-view">View Details</button>
                            </div>
                        </div>
                    </div>

                    <div class="property-card">
                        <img src="https://images.unsplash.com/photo-1572120471610-3b0f0f4ebd4f?auto=format&fit=crop&w=400&q=80" alt="Property" class="property-image">
                        <div class="property-details">
                            <div class="property-address">Address, Villa, Miamian</div>
                            <div class="property-price">₱850,000</div>
                            <div class="property-specs">3 Bd, 2 Ba</div>
                            <div class="property-description">Modern villa, modern home cottage with seamless and with condition transparent.</div>
                            <div class="property-actions">
                                <button class="btn-save">Save Property</button>
                                <button class="btn-view">View Details</button>
                            </div>
                        </div>
                    </div>

                    <div class="property-card">
                        <img src="https://images.unsplash.com/photo-1600573472550-8090b5e0745e?auto=format&fit=crop&w=400&q=80" alt="Property" class="property-image">
                        <div class="property-details">
                            <div class="property-address">Address Beachfront condo</div>
                            <div class="property-price">₱750,000</div>
                            <div class="property-specs">3 Bd, 2 Ba</div>
                            <div class="property-description">A beachfront condo wandtime consummats and easy to commuted uncovered new home.</div>
                            <div class="property-actions">
                                <button class="btn-save">Save Property</button>
                                <button class="btn-view">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="map-container">
                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #f0f0f0 0%, #e8e8e8 100%); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #999; font-size: 14px;">
                    Map View
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Your Property - Dream Home</title>
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
        .banner {
            background: linear-gradient(135deg, #8B9D6F 0%, #7a8860 100%);
            color: white;
            text-align: center;
            padding: 30px 20px;
            margin-top: 70px;
            font-size: 18px;
            font-weight: 500;
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
            padding: 40px 20px;
        }
        .hero-header h1 {
            font-size: 48px;
            font-weight: 700;
            letter-spacing: 2px;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .form-section {
            background: white;
            border: 1px solid #eee;
            border-radius: 12px;
            padding: 40px;
            margin-bottom: 40px;
        }
        .form-section h2 {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }
        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
        }
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #8B9D6F;
            box-shadow: 0 0 0 3px rgba(139, 157, 111, 0.1);
        }
        .checklist {
            background: #f5f5f5;
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 40px;
        }
        .checklist h3 {
            font-size: 20px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }
        .checklist-item {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding: 12px;
            background: white;
            border-radius: 8px;
        }
        .checklist-item input[type="checkbox"] {
            width: 20px;
            height: 20px;
            margin-right: 15px;
            cursor: pointer;
        }
        .checklist-item label {
            margin: 0;
            cursor: pointer;
            flex: 1;
        }
        .submit-btn {
            background: #8B9D6F;
            color: white;
            padding: 14px 40px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
        }
        .submit-btn:hover {
            background: #7a8860;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .additional-info {
            background: #e8e8e8;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
            font-weight: 600;
            color: #333;
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

    <div class="banner">
        Ready to find your next great tenant? Let's list your beautiful rental home!
    </div>

    <div class="hero-header">
        <h1>Get started with Your Property Listing</h1>
    </div>

    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 40px;">
            <div>
                <div class="form-section">
                    <h2>PROPERTY LISTING</h2>
                    
                    <div class="form-group">
                        <label>Property Type</label>
                        <select>
                            <option>Residential</option>
                            <option>Commercial</option>
                            <option>Industrial</option>
                        </select>
                    </div>

                    <div class="form-row">
                        <div>
                            <label>Beds</label>
                            <input type="number" placeholder="Number of bedrooms">
                        </div>
                        <div>
                            <label>Baths</label>
                            <input type="number" placeholder="Number of bathrooms">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Rental Price per Month</label>
                        <input type="number" placeholder="₱ 0,000">
                    </div>

                    <div class="form-group">
                        <label>Square Feet</label>
                        <input type="number" placeholder="0,000">
                    </div>

                    <div class="form-group">
                        <label>Deposit Amount</label>
                        <input type="number" placeholder="₱ 0,000">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" placeholder="Google Maps address autocomplete...">
                    </div>

                    <div class="form-group">
                        <label>Contact Name</label>
                        <input type="text" placeholder="Contact Name">
                    </div>

                    <div class="form-row">
                        <div>
                            <label>Contact Phone</label>
                            <input type="tel" placeholder="Contact Phone">
                        </div>
                        <div>
                            <label>Contact Email</label>
                            <input type="email" placeholder="Contact Email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea placeholder="Property description..."></textarea>
                    </div>

                    <div class="additional-info">
                        INSERT ADDITIONAL DATA IF NEEDED
                    </div>

                    <button class="submit-btn">Continue to Step 2</button>
                </div>
            </div>

            <div>
                <div class="checklist">
                    <h3>Listing Checklist</h3>
                    
                    <div class="checklist-item">
                        <input type="checkbox" id="check1">
                        <label for="check1">✓ Property Basics</label>
                    </div>

                    <div class="checklist-item">
                        <input type="checkbox" id="check2">
                        <label for="check2">✓ Contact Info</label>
                    </div>

                    <div class="checklist-item">
                        <input type="checkbox" id="check3">
                        <label for="check3">Photo Gallery</label>
                    </div>

                    <div class="checklist-item">
                        <input type="checkbox" id="check4">
                        <label for="check4">Property Narrative</label>
                    </div>

                    <div class="checklist-item">
                        <input type="checkbox" id="check5">
                        <label for="check5">Preview and Submit</label>
                    </div>

                    <div style="margin-top: 30px; padding-top: 30px; border-top: 1px solid #ddd;">
                        <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 15px;">
                            <span style="font-size: 20px;">🏠</span>
                            <span style="font-weight: 600;">Lease Terms</span>
                        </div>

                        <div style="margin-bottom: 10px;">
                            <input type="radio" id="lease1" name="lease" value="3">
                            <label for="lease1" style="display: inline; margin-left: 8px;">3 Months</label>
                        </div>

                        <div style="margin-bottom: 10px;">
                            <input type="radio" id="lease2" name="lease" value="6">
                            <label for="lease2" style="display: inline; margin-left: 8px;">6 Months</label>
                        </div>

                        <div style="margin-bottom: 10px;">
                            <input type="radio" id="lease3" name="lease" value="12">
                            <label for="lease3" style="display: inline; margin-left: 8px;">12 Months</label>
                        </div>

                        <div style="margin-bottom: 10px;">
                            <input type="radio" id="lease4" name="lease" value="24">
                            <label for="lease4" style="display: inline; margin-left: 8px;">24 Months</label>
                        </div>

                        <div>
                            <input type="radio" id="lease5" name="lease" value="month">
                            <label for="lease5" style="display: inline; margin-left: 8px;">Month-to-Month</label>
                        </div>
                    </div>

                    <div style="margin-top: 30px;">
                        <button style="background: #5B9DB5; color: white; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; width: 100%; font-weight: 600;">Add up to 20 Photos</button>
                    </div>

                    <div style="margin-top: 15px; text-align: center;">
                        <button style="background: #8B9D6F; color: white; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">Continue to Step 2</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

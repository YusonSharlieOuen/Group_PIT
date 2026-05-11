<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Dream Home</title>
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
        .hero-section {
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.2) 100%), 
                        url('https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat;
            background-size: cover;
            min-height: 400px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 80px 20px 20px;
            margin-top: 40px;
            border-radius: 16px;
        }
        .hero-section h2 {
            font-size: 36px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .hero-section p {
            font-size: 18px;
            font-weight: 500;
            max-width: 700px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
        }
        .sections-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin: 60px 0;
        }
        .section-card {
            background: #f5f5f5;
            padding: 40px 30px;
            border-radius: 12px;
            text-align: center;
            min-height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .section-card h3 {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 20px;
        }
        .section-card p {
            font-size: 14px;
            color: #666;
            line-height: 1.8;
        }
        .cta-section {
            text-align: center;
            margin-top: 60px;
        }
        .learn-btn {
            display: inline-block;
            padding: 14px 40px;
            background: #22C55E;
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        .learn-btn:hover {
            background: #1ea950;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(34, 197, 94, 0.3);
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

    <div class="container">
        <div class="hero-section">
            <h2>Our Story: Empathy in Every Transaction</h2>
            <p>Our Mission: Redefining the Rental Experience</p>
        </div>

        <div class="sections-grid">
            <div class="section-card">
                <h3>Founder Vision</h3>
                <p>Founded on the belief that real estate should be accessible and transparent for everyone. We envision a world where finding the perfect home is a delightful and straightforward experience.</p>
            </div>

            <div class="section-card">
                <h3>DREAM HOME TEAM</h3>
                <p>Our dedicated team brings decades of combined experience in real estate, property management, and customer service. We're committed to making every interaction meaningful and helping you achieve your real estate goals.</p>
            </div>

            <div class="section-card">
                <h3>Why Choose Us?</h3>
                <p>We combine cutting-edge technology with personalized service. Our platform is designed with you in mind, offering comprehensive tools, expert support, and a community dedicated to your success in finding or renting your dream home.</p>
            </div>
        </div>

        <div class="cta-section">
            <button class="learn-btn">LEARN MORE about Our Story</button>
        </div>
    </div>
</body>
</html>

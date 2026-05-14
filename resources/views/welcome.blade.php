<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dream Home - Property Management</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
    </head>
    <body>
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            html,
            body {
                width: 100%;
                min-height: 100%;
                overflow-x: hidden;
                font-family: 'Poppins', sans-serif;
            }

            .hero {
                position: relative;
                width: 100vw;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 96px 20px 40px;
                overflow: hidden;
                background:
                    linear-gradient(135deg, rgba(0, 0, 0, 0.45), rgba(0, 0, 0, 0.25)),
                    url("{{ asset('images/photo2.jpg') }}") center center / cover no-repeat fixed;
            }

            .hero::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(to bottom, rgba(0, 0, 0, 0.18), rgba(0, 0, 0, 0.42));
                z-index: 1;
            }

            .nav {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 100;
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 24px;
                padding: 20px 40px;
                background: rgba(0, 0, 0, 0.3);
                backdrop-filter: blur(10px);
            }

            .logo {
                flex: 0 0 auto;
                color: white;
                font-size: 28px;
                font-weight: 700;
                letter-spacing: 2px;
                text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
                white-space: nowrap;
            }

            .nav-links {
                display: flex;
                align-items: center;
                justify-content: flex-end;
                gap: 20px;
                list-style: none;
                flex-wrap: wrap;
            }

            .nav-links a {
                display: inline-block;
                color: white;
                text-decoration: none;
                font-weight: 500;
                font-size: 14px;
                padding: 10px 14px;
                border: 2px solid transparent;
                border-radius: 4px;
                transition: all 0.3s ease;
                text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.3);
                white-space: nowrap;
            }

            .nav-links a:hover {
                border-color: white;
                background: rgba(255, 255, 255, 0.1);
            }

            .hero-content {
                position: relative;
                z-index: 5;
                text-align: center;
                color: white;
            }

            .hero-title {
                font-size: clamp(42px, 8vw, 72px);
                font-weight: 700;
                letter-spacing: 4px;
                margin-bottom: 20px;
                text-shadow: 3px 3px 12px rgba(0, 0, 0, 0.5);
                animation: fadeInDown 0.8s ease-out;
            }

            .hero-subtitle {
                font-size: 18px;
                font-weight: 300;
                margin-bottom: 40px;
                text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
                letter-spacing: 1px;
                animation: fadeInUp 0.8s ease-out 0.2s backwards;
            }

            .cta-buttons {
                display: flex;
                gap: 20px;
                justify-content: center;
                flex-wrap: wrap;
                animation: fadeInUp 0.8s ease-out 0.4s backwards;
            }

            .btn {
                display: inline-block;
                padding: 14px 40px;
                color: white;
                font-family: 'Poppins', sans-serif;
                font-size: 15px;
                font-weight: 600;
                letter-spacing: 1px;
                text-decoration: none;
                border: 2px solid white;
                border-radius: 4px;
                cursor: pointer;
                transition: all 0.3s ease;
            }

            .btn-primary {
                background: white;
                color: #2c2c2c;
            }

            .btn-primary:hover {
                background: rgba(255, 255, 255, 0.9);
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            }

            .btn-secondary {
                background: transparent;
            }

            .btn-secondary:hover {
                background: rgba(255, 255, 255, 0.1);
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            }

            .mission {
                background: white;
                padding: 60px 20px;
                text-align: center;
            }

            .mission-inner {
                max-width: 900px;
                margin: 0 auto;
            }

            .mission-text {
                color: #333;
                font-size: 18px;
                line-height: 1.8;
                margin-bottom: 40px;
            }

            .featured-properties {
                background: #f5f5f5;
                padding: 60px 20px;
            }

            .property-grid {
                max-width: 1000px;
                margin: 0 auto;
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 30px;
            }

            .property-card {
                height: 200px;
                overflow: hidden;
                border-radius: 8px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            }

            .property-card img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            @keyframes fadeInDown {
                from {
                    opacity: 0;
                    transform: translateY(-30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 900px) {
                .nav {
                    align-items: flex-start;
                    flex-direction: column;
                    padding: 16px 20px;
                }

                .nav-links {
                    justify-content: flex-start;
                    gap: 8px;
                }

                .nav-links a {
                    padding: 7px 10px;
                    font-size: 12px;
                }

                .logo {
                    font-size: 20px;
                }

                .hero {
                    padding-top: 150px;
                    background-attachment: scroll;
                }

                .hero-title {
                    letter-spacing: 2px;
                }

                .hero-subtitle {
                    font-size: 14px;
                }

                .btn {
                    padding: 12px 30px;
                    font-size: 13px;
                }
            }
        </style>

        <div class="hero" id="home">
            <nav class="nav">
                <div class="logo">DREAM HOME</div>
                <ul class="nav-links">
                    <li><a href="{{ route('home.find') }}">Find a Home</a></li>
                    <li><a href="{{ route('property.list') }}">List Your Property</a></li>
                    <li><a href="{{ route('services') }}">Services</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        @else
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @endif
                            <li><a href="{{ route('login') }}">Log In</a></li>
                        @endauth
                    @endif
                </ul>
            </nav>

            <div class="hero-content">
                <h1 class="hero-title">DREAM HOME</h1>
            </div>
        </div>

        <section class="mission">
            <div class="mission-inner">
                <p class="mission-text">
                    At Dream Home, we believe that a house is more than just a structure. It is the foundation for your best life. As a specialized rental branch, we curate a premium portfolio of homes designed to meet the diverse needs of today's renters. Whether you are a homeowner looking for a trusted partner to care for your property, or a tenant searching for your next great chapter, Dream Home is here to make the transition seamless, comfortable, and rewarding.
                </p>
            </div>
        </section>

        <section class="featured-properties">
            <div class="property-grid">
                <div class="property-card">
                    <img src="{{ asset('images/photo1.jpg') }}" alt="Property 1">
                </div>
                <div class="property-card">
                    <img src="{{ asset('images/photo2.jpg') }}" alt="Property 2">
                </div>
                <div class="property-card">
                    <img src="{{ asset('images/photol3.jpg') }}" alt="Property 3">
                </div>
                <div class="property-card">
                    <img src="{{ asset('images/photo4.jpg') }}" alt="Property 4">
                </div>
            </div>
        </section>
    </body>
</html>

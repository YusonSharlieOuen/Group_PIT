<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dream Home - Property Management</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet" />
    </head>
    <body style="margin: 0; padding: 0; font-family: 'Poppins', sans-serif; min-height: 100vh;">
        <style>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body {
                font-family: 'Poppins', sans-serif;
            }
            .hero {
                background: linear-gradient(135deg, rgba(0, 0, 0, 0.4) 0%, rgba(0, 0, 0, 0.2) 100%), url('/images/photo2.jpg') center/cover no-repeat;
                background-size: 1920px 1080px;
                background-attachment: fixed;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                padding: 0 20px;
                position: relative;
                overflow: hidden;
            }
            .hero::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.4));
                z-index: 1;
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
                text-shadow: 2px 2px 8px rgba(0,0,0,0.5);
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
                padding: 10px 20px;
                border: 2px solid transparent;
                border-radius: 4px;
                transition: all 0.3s ease;
                text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
            }
            .nav-links a:hover {
                border-color: white;
                background: rgba(255,255,255,0.1);
            }
            .hero-content {
                position: relative;
                z-index: 5;
                text-align: center;
                color: white;
                margin-top: 0;
                margin-top: 60px;
            }
            .hero-title {
                font-size: 72px;
                font-weight: 700;
                letter-spacing: 4px;
                margin-bottom: 20px;
                text-shadow: 3px 3px 12px rgba(0,0,0,0.5);
                animation: fadeInDown 0.8s ease-out;
            }
            .hero-subtitle {
                font-size: 18px;
                font-weight: 300;
                margin-bottom: 40px;
                text-shadow: 2px 2px 8px rgba(0,0,0,0.4);
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
                padding: 14px 40px;
                font-size: 15px;
                font-weight: 600;
                border: 2px solid white;
                border-radius: 4px;
                cursor: pointer;
                transition: all 0.3s ease;
                text-decoration: none;
                display: inline-block;
                letter-spacing: 1px;
                font-family: 'Poppins', sans-serif;
            }
            .btn-primary {
                background: white;
                color: #2c2c2c;
            }
            .btn-primary:hover {
                background: rgba(255,255,255,0.9);
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            }
            .btn-secondary {
                background: transparent;
                color: white;
                border-color: white;
            }
            .btn-secondary:hover {
                background: rgba(255,255,255,0.1);
                transform: translateY(-2px);
                box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            }
            .features {
                display: none;
            }
            .feature {
                text-align: center;
                color: white;
            }
            .feature-number {
                font-size: 32px;
                font-weight: 700;
                margin-bottom: 5px;
                text-shadow: 2px 2px 8px rgba(0,0,0,0.4);
            }
            .feature-text {
                font-size: 14px;
                font-weight: 500;
                text-shadow: 1px 1px 4px rgba(0,0,0,0.3);
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
            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }
            @media (max-width: 768px) {
                .hero-title {
                    font-size: 42px;
                    letter-spacing: 2px;
                    margin-top: 50px;
                }
                .hero-subtitle {
                    font-size: 14px;
                }
                .nav {
                    padding: 15px 20px;
                    flex-direction: row;
                    gap: 10px;
                }
                .nav-links {
                    gap: 10px;
                    flex-wrap: wrap;
                    justify-content: flex-end;
                }
                .nav-links a {
                    padding: 8px 12px;
                    font-size: 12px;
                }
                .logo {
                    font-size: 18px;
                }
                .features {
                    flex-direction: column;
                    gap: 40px;
                    bottom: 60px;
                }
                .btn {
                    padding: 12px 30px;
                    font-size: 13px;
                }
                .hero-content {
                    margin-top: 40px;
                }
            }
        </style>

        <div class="hero">
            <nav class="nav">
                <div class="logo">DREAM HOME</div>
                <ul class="nav-links">
                    @if (Route::has('login'))
                        @auth
                            <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                        @else
                            <li><a href="{{ route('login') }}">Log In</a></li>
                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}">Register</a></li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </nav>

            <div class="hero-content">
                <h1 class="hero-title">DREAM HOME</h1>
                <p class="hero-subtitle">Find Your Perfect Property Today</p>
                <div class="cta-buttons">
                    <a href="{{ route('login') }}" class="btn btn-primary">Get Started</a>
                    <button class="btn btn-secondary" onclick="alert('Explore our amazing properties')">Explore</button>
                </div>
            </div>

            <div class="features">
                <div class="feature">
                    <div class="feature-number">500+</div>
                    <div class="feature-text">Properties</div>
                </div>
                <div class="feature">
                    <div class="feature-number">10K+</div>
                    <div class="feature-text">Happy Clients</div>
                </div>
                <div class="feature">
                    <div class="feature-number">24/7</div>
                    <div class="feature-text">Support</div>
                </div>
            </div>
        </div>
    </body>
</html>

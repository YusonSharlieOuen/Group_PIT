<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            [x-cloak] { display: none !important; }
        </style>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 overflow-x-hidden">
        <div x-data="{ sidebarOpen: true }" class="min-h-screen">
            @auth
                @include('layouts.navigation')
            @else
                <nav class="border-b border-gray-100 bg-white">
                    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                        <a href="{{ url('/') }}" class="font-serif text-xl font-semibold tracking-[0.25em] text-gray-950">
                            DREAM HOME
                        </a>

                        <div class="hidden items-center gap-6 text-sm font-medium text-gray-600 sm:flex">
                            <a href="{{ route('home.find') }}" class="hover:text-gray-950">Find a Home</a>
                            <a href="{{ route('property.list') }}" class="hover:text-gray-950">List Your Property</a>
                            <a href="{{ route('services') }}" class="hover:text-gray-950">Services</a>
                            <a href="{{ route('about') }}" class="hover:text-gray-950">About Us</a>
                            <a href="{{ route('contact') }}" class="hover:text-gray-950">Contact</a>
                            <a href="{{ route('login') }}" class="rounded-md bg-gray-900 px-4 py-2 text-white hover:bg-gray-700">Log In</a>
                        </div>
                    </div>
                </nav>
            @endauth

            <div class="transition-all duration-300" @auth :class="sidebarOpen ? 'lg:pl-64' : 'lg:pl-20'" @endauth>
                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white border-b border-gray-100">
                        <div class="mx-auto max-w-7xl px-4 py-5 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
    </body>
</html>

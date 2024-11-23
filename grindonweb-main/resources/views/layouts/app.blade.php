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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <!-- Hero Area (Header Section) -->
            <div class="hero_area">
                <header class="header_section">
                    <nav class="navbar navbar-expand-lg custom_nav-container">
                        <!-- Logo & Navigation -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ asset('images/Logo/grindlogo.png') }}" style="height: 50px; width: auto;" alt="Logo">
                        </a>

                        <!-- Navbar Toggle (for mobile responsiveness) -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Navbar Links -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('shop') }}">Shop</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('why-us') }}">Why Us</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('testimonials') }}">Testimonials</a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </nav>
                </header>
            </div>
            <!-- End Hero Area (Header Section) -->

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>

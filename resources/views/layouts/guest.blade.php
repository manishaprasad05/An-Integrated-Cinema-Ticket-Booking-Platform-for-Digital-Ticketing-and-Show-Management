<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CinemaT Booking') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased min-h-screen bg-cover bg-center"
      style="background-image: url('/bg.jpg');">


    <div class="min-h-screen flex flex-col justify-center items-center bg-black/60 backdrop-blur-sm">
 

        <!-- Auth Card -->
        <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <!-- Logo + App Name -->
        <div class="mb-6 flex flex-col items-center">
            <a href="{{ url('/') }}" class="flex flex-col items-center">

                <!-- Circular Logo -->
                <div class="w-20 h-20 rounded-full bg-white shadow-md overflow-hidden flex items-center justify-center">
                    <img 
                        src="{{ asset('storage/logo.jpeg') }}"
                        alt="CinemaT Booking Logo"
                        class="w-full h-full object-cover"
                    >
                </div>

                <!-- App Name -->
                <h1 class="mt-3 text-xl font-semibold text-gray-800">
                    CinemaT Booking
                </h1>
            </a>
        </div>
            {{ $slot }}
        </div>

    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Cinema Ticket Booking')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- USER CSS -->
    <link rel="stylesheet" href="{{ asset('css/user.css') }}">
</head>

<body>

<!-- HEADER -->
<header class="user-header">
    <div class="logo-box">
        <div class="logo-circle">
            <img src="{{ asset('storage/logo.jpeg') }}" alt="CinemaT Booking Logo">
        </div>
        <span class="logo-text">CinemaT Booking</span>
    </div>

    <nav class="nav-links">

        <a href="{{ route('welcome') }}" class="nav-item">
            <x-heroicon-s-home class="nav-icon" />
            <span>Home</span>
        </a>

    <a href="{{ route('movie') }}" class="nav-item">
        <x-heroicon-s-film class="nav-icon" />
        <span>Movies</span>
    </a>

        <a href="{{ route('about') }}" class="nav-item">
            <x-heroicon-s-information-circle class="nav-icon" />
            <span>About</span>
        </a>

        <a href="{{ route('my.bookings') }}" class="nav-item">
            <x-heroicon-s-ticket class="nav-icon" />
            <span>My Bookings</span>
        </a>

        @auth
            <span class="user-name">
                <x-heroicon-s-user-circle class="nav-icon" />
                Hi, {{ auth()->user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}" class="inline-form">
                @csrf
                <button type="submit" class="logout-btn">
                    <x-heroicon-s-arrow-right-on-rectangle class="nav-icon" />
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="login-btn">
                <x-heroicon-s-arrow-left-on-rectangle class="nav-icon" />
                Login
            </a>

            <a href="{{ route('register') }}" class="register-btn">
                <x-heroicon-s-user-plus class="nav-icon" />
                Register
            </a>
        @endauth

    </nav>
</header>

<!-- PAGE CONTENT -->
<main style="flex:1;">
    @yield('content')
</main>

<!-- FOOTER -->
<footer class="cinema-footer">

    <p>
        © <span>2026 CinemaT Booking System</span> |
        Made With <x-heroicon-s-heart class="footer-icon heart" /> For Movie Lovers
    </p>

    <p>
        <x-heroicon-s-envelope class="footer-icon" /> info@CinemaTbooking.com |
        <x-heroicon-s-phone class="footer-icon" /> +91-9978547675 |
        <x-heroicon-s-map-pin class="footer-icon" /> Rajkot, Gujarat, India
    </p>

    <p class="social-links">
        Follow Us:

        <a href="https://facebook.com" target="_blank">
            <x-heroicon-s-globe-alt class="footer-icon" /> Facebook
        </a> |

        <a href="https://instagram.com" target="_blank">
            <x-heroicon-s-camera class="footer-icon" /> Instagram
        </a> |

        <a href="https://twitter.com" target="_blank">
            <x-heroicon-s-chat-bubble-left-right class="footer-icon" /> Twitter
        </a> |

        <a href="https://linkedin.com" target="_blank">
            <x-heroicon-s-briefcase class="footer-icon" /> LinkedIn
        </a>
    </p>

</footer>

</body>
</html>

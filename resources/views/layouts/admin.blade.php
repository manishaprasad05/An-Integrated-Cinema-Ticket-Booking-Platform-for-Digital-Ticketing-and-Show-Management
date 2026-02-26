<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel - CinemaT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0f172a;
            color: white;
            font-family: Poppins, sans-serif;
        }
        /* Header Title Color */
.page-title {
    color: #f8c146; /* Gold */
    font-weight: 700;
    text-shadow: 0 0 8px rgba(248, 193, 70, 0.4);
}

/* Icon color */
.title-icon {
    color: #f8c146;
}

        .sidebar {
            width: 260px;
            height: 100vh;
            background: #1e293b;
            padding: 25px 20px;
            position: fixed;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 30px;
        }

        .sidebar-header h4 {
            color: #facc15;
            margin: 0;
            font-size: 18px;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px;
            margin-bottom: 10px;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #6366f1;
        }

        .sidebar svg {
            width: 18px;
            height: 18px;
        }

        .content {
            margin-left: 280px;
            padding: 30px;
        }

        .logo {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden;
            background: #fff;
            border: 2px solid #fff;
        }

        .logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>

<div class="sidebar">

    <!-- Logo Section -->
    <div class="sidebar-header">
        <div class="logo">
            <img src="{{ asset('storage/logo.jpeg') }}">
        </div>
        <div>
            <h3>CinemaT</h3>
            <h4>Admin Panel<h4>
        </div>
    </div>

    <!-- Dashboard -->
    <a href="{{ route('admin.dashboard') }}">
        <!-- Home Icon -->
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path d="M3 9.75L12 3l9 6.75V20a2 2 0 0 1-2 2h-4v-6H9v6H5a2 2 0 0 1-2-2V9.75z"/>
        </svg>
        Dashboard
    </a>

    <!-- Movies -->
    <a href="{{ route('admin.movies.index') }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <rect x="3" y="4" width="18" height="16" rx="2"/>
            <path d="M7 4v16M17 4v16"/>
        </svg>
        All Movies
    </a>

    <!-- Add Movie -->
    <a href="{{ route('admin.movies.create') }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <path d="M12 5v14M5 12h14"/>
        </svg>
        Add Movie
    </a>

    <!-- Bookings -->
    <a href="{{ route('admin.bookings') }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <rect x="3" y="8" width="18" height="13" rx="2"/>
            <path d="M16 3v5M8 3v5"/>
        </svg>
        Bookings
    </a>

    <!-- Users -->
    <a href="{{ route('admin.users') }}">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <circle cx="9" cy="7" r="4"/>
            <path d="M17 11v-1a4 4 0 0 0-4-4"/>
            <path d="M3 21v-2a4 4 0 0 1 4-4h4"/>
        </svg>
        Users
    </a>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger w-100">
        Logout
    </button>
</form>

    </form>

</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>

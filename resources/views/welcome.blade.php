@extends('layouts.user')

@section('content')

<style>
/* ===== RESET ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', sans-serif;
    background: #f3f4f6;
}

/* ===== HERO ===== */
.hero {
    position: relative;
    height: 68vh;
    background: url('{{ asset('bghome.jpg') }}') center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to bottom, rgba(0,0,0,0.7), rgba(0,0,0,0.9));
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 700px;
}

.hero h1 {
    font-size: 50px;
    margin-bottom: 20px;
    color: #facc15;
}

.hero p {
    font-size: 18px;
    margin-bottom: 30px;
    opacity: 0.9;
}

.btn-primary {
    background: #facc15;
    color: black;
    padding: 12px 30px;
    text-decoration: none;
    font-weight: bold;
    border-radius: 8px;
    transition: 0.3s;
    display: inline-block;
}

.btn-primary:hover {
    background: #eab308;
    transform: scale(1.05);
}

/* ===== SECTION ===== */
.section {
    padding: 70px 20px;
    text-align: center;
}

.dark-section {
    background: #111;
    color: white;
}

.section-title {
    font-size: 30px;
    margin-bottom: 50px;
}

/* ===== MOVIE GRID ===== */
.movie-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    max-width: 1200px;
    margin: auto;
}

/* ===== MOVIE CARD ===== */
.movie-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    transition: 0.4s ease;
    position: relative;
}

.dark-section .movie-card {
    background: #1f1f1f;
}

.movie-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.3);
}

/* FIXED IMAGE SIZE */
.movie-card img {
    width: 100%;
    height: 380px;        /* SAME SIZE FOR ALL POSTERS */
    object-fit: cover;    /* VERY IMPORTANT */
    transition: 0.4s ease;
}

.movie-card:hover img {
    transform: scale(1.08);
}

/* MOVIE INFO */
.movie-info {
    padding: 20px;
}

.movie-info h3 {
    margin-bottom: 8px;
    font-size: 18px;
}

.movie-info p {
    font-size: 14px;
    color: gray;
    margin-bottom: 18px;
}

.dark-section .movie-info p {
    color: #bbb;
}

/* BUTTON */
.btn-dark {
    display: inline-block;
    padding: 8px 22px;
    background: green;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-size: 14px;
    transition: 0.3s;
}


.btn-dark:hover {
    background: #333333;
    transform: scale(1.05);
}

/* COMING SOON OVERLAY */
.coming-soon {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.75);
    color: #facc15;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 18px;
    opacity: 0;
    transition: 0.3s;
}

.movie-card:hover .coming-soon {
    opacity: 1;
}

/* ===== CTA ===== */
.cta {
    background: #111;
    color: white;
    text-align: center;
    padding: 70px 20px;
}

.cta h2 {
    margin-bottom: 15px;
    font-size: 28px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 1024px) {
    .movie-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .movie-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .hero h1 {
        font-size: 32px;
    }

    .movie-card img {
        height: 320px;
    }
}

@media (max-width: 480px) {
    .movie-grid {
        grid-template-columns: 1fr;
    }

    .movie-card img {
        height: 300px;
    }
}
</style>


<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1>Book Movies Delivered Fast</h1>
        <p>Watch latest blockbusters in just a few clicks.</p>
        <a href="{{ route('movie') }}" class="btn-primary">🎟 Book Now</a>
    </div>
</section>


<!-- LATEST MOVIES -->
<section class="section">
    <h2 class="section-title">🔥 Latest Movies</h2>

    <div class="movie-grid">
        @forelse($movies ?? [] as $movie)
            <div class="movie-card">
                <img src="{{ asset('storage/posters/'.$movie->poster) }}" alt="{{ $movie->title }}">

                <div class="movie-info">
                    <h3>{{ $movie->title }}</h3>
                    <p>{{ $movie->genre }} • {{ $movie->language }}</p>
                    <a href="{{ route('movie.details', $movie->id) }}" class="btn-dark">
                        Book Ticket
                    </a>
                </div>
            </div>
        @empty
            <p>No movies available.</p>
        @endforelse
    </div>
</section>


<!-- UPCOMING MOVIES -->
<section class="section dark-section">
    <h2 class="section-title">🎬 Upcoming Movies</h2>

    <div class="movie-grid">
        @forelse($upcomingMovies ?? [] as $movie)
            <div class="movie-card">
                <img src="{{ asset('storage/posters/'.$movie->poster) }}" alt="{{ $movie->title }}">
                <div class="coming-soon">Coming Soon</div>
            </div>
        @empty
            <p>No upcoming movies.</p>
        @endforelse
    </div>
</section>


<!-- CALL TO ACTION -->
<section class="cta">
    <h2>Ready for the Show?</h2>
    <p>Reserve your seat now and enjoy the cinema experience.</p>
    <a href="{{ route('movie') }}" class="btn-primary">Get Tickets</a>
</section>

@endsection

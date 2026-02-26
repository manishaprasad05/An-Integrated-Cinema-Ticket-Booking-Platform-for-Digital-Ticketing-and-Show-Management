@extends('layouts.user')

@section('title', 'About CinemaT Booking')

@section('content')
<div class="container my-5 about-page">

    <!-- HERO SECTION -->
    <section class="about-hero text-center mb-5">
        <h1 class="mb-3 d-flex justify-content-center align-items-center gap-2">
            <x-heroicon-o-film class="icon" />
            About CinemaT Theaters
        </h1>

        <p class="mx-auto hero-text">
            <strong>CinemaT Booking Cinemas</strong> are designed to deliver a premium
            movie-watching experience with modern infrastructure, advanced sound systems,
            and maximum comfort.
        </p>
    </section><br>

    <!-- FACILITIES -->
    <section class="about-section mb-5">
        <h2 class="mb-4 d-flex align-items-center gap-2">
            <x-heroicon-o-building-office class="icon" />
            Our Cinema Facilities
        </h2>

        <div class="row g-4">
            <div class="col-md-6">
                <h4 class="d-flex align-items-center gap-2">
                    <x-heroicon-o-video-camera class="icon-sm" />
                    Screening Technology
                </h4>
                <ul>
                    <li>Digital 2K & 4K Projection</li>
                    <li>Dolby Digital & Surround Sound</li>
                    <li>Crystal-clear picture quality</li>
                    <li>Noise-isolated cinema halls</li>
                </ul>
            </div>

            <div class="col-md-6">
                <h4 class="d-flex align-items-center gap-2">
                    <x-heroicon-o-user class="icon-sm" />
                    Seating Comfort
                </h4>
                <ul>
                    <li>Ergonomic push-back seats</li>
                    <li>Premium recliner seating</li>
                    <li>Spacious legroom</li>
                    <li>Wheelchair-accessible seating</li>
                </ul>
            </div>
        </div>
    </section><br>

    <!-- BOOKING -->
    <section class="about-section mb-5">
        <h2 class="mb-3 d-flex align-items-center gap-2">
            <x-heroicon-o-ticket class="icon" />
            Ticket Booking Experience
        </h2>
        <ul>
            <li>Search movies by language, genre & rating</li>
            <li>Select preferred seats easily</li>
            <li>Fast & secure booking</li>
            <li>Booking history for logged-in users</li>
        </ul>
    </section><br>

    <!-- CINEMA GALLERY -->
    <section class="cinema-section mb-5">
        <h2 class="mb-4 d-flex align-items-center gap-2">
            <x-heroicon-o-building-office class="icon" />
            Our Cinema
        </h2>

        <div class="row g-4">

            <div class="col-lg-4 col-md-6">
                <div class="cinema-card shadow-sm">
                    <img src="{{ asset('storage/cinemas/cinema1.png') }}" alt="">
                    <div class="cinema-text">
                        <h5>Luxury Cinema Hall</h5>
                        <p>Dolby Atmos • Recliner Seats</p>
                    </div>
                </div>
            </div><br>

            <div class="col-lg-4 col-md-6">
                <div class="cinema-card shadow-sm">
                    <img src="{{ asset('storage/cinemas/cinema2.png') }}" alt="">
                    <div class="cinema-text">
                        <h5>Premium Seating</h5>
                        <p>Comfortable & Spacious</p>
                    </div>
                </div>
            </div><br>

            <div class="col-lg-4 col-md-6 mx-md-auto">
                <div class="cinema-card shadow-sm">
                    <img src="{{ asset('storage/cinemas/cinema3.png') }}" alt="">
                    <div class="cinema-text">
                        <h5>Ultra HD Screens</h5>
                        <p>4K Projection Experience</p>
                    </div>
                </div>
            </div>

        </div>
    </section><br>

    <!-- LOCATIONS -->
    <section class="about-section mb-5">
        <h2 class="mb-3 d-flex align-items-center gap-2">
            <x-heroicon-o-map-pin class="icon" />
            Cinema Locations
        </h2>

        <div class="table-responsive">
            <table class="table cinema-table text-center align-middle">
                <thead>
                    <tr>
                        <th>City</th>
                        <th>Cinema Name</th>
                        <th>Screens</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Ahmedabad</td>
                        <td>CinemaT Multiplex</td>
                        <td><span class="badge bg-primary">5</span></td>
                    </tr>
                    <tr>
                        <td>Surat</td>
                        <td>CinemaT Grand</td>
                        <td><span class="badge bg-success">4</span></td>
                    </tr>
                    <tr>
                        <td>Vadodara</td>
                        <td>CinemaT Premium</td>
                        <td><span class="badge bg-warning">3</span></td>
                    </tr>
                    <tr>
                        <td>Rajkot</td>
                        <td>CinemaT Digital</td>
                        <td><span class="badge bg-danger">2</span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section><br>

    <!-- CONTACT -->
    <section class="about-section text-center">
        <h2 class="mb-3 d-flex justify-content-center align-items-center gap-2">
            <x-heroicon-o-phone class="icon" />
            Contact Information
        </h2>
        <p>Email: support@cinematbooking.com</p>
        <p>Head Office: Gujarat, India</p>
        <p>Customer Care: +91-9978547675</p>
    </section>

</div>

<style>

/* ICON SIZE FIX */
.icon {
    width: 30px !important;
    height: 30px !important;
     stroke: black !important;
    color: black !important;
}
.icon-sm {
    width: 20px !important;
    height: 20px !important;
}



.about-page {
    max-width: 1200px;
    margin: auto;
    padding: 14px;
    font-family: "Poppins", "Segoe UI", Arial, sans-serif;
    color: #111827;
    line-height: 1.7;
}

/* HERO SECTION */
.about-hero {
    padding: 60px 25px;
    background: linear-gradient(135deg,  #6366f1,  #6366f1);
    color: white;
    border-radius: 18px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.2);
}
.about-hero h1 {
    font-size: 2rem;
    font-weight: 700;
}
.hero-text {
    max-width: 760px;
    font-size: 1.05rem;
    color: #d1d5db;
}

/* SECTION HEADINGS */
.about-section h2,
.cinema-section h2 {
    font-size: 40px;
    font-weight: 700;
    margin-bottom: 18px;
    color: #513737;
}

/* SUB TITLES */
.about-section h4 {
    font-size: 30px;
    font-weight: 600;
    color: #383751;
    margin-bottom: 8px;
}

/* LIST STYLE IMPROVEMENT */
.about-section ul {
    padding-left: 18px;
    margin-top: 6px;
}
.about-section ul li {
    font-size: 20px;
    margin-bottom: 6px;
    color: #374151;
}


/* CONTACT TEXT */
.about-section p {
    font-size: 20px;
    color: #374151;
}

/* HERO */
.about-hero {
    padding: 50px 20px;
    background: linear-gradient(135deg,#9333ea, #9333ea);
    color: white;
    border-radius: 14px;
}
.hero-text {
    max-width: 720px;
    color: black;
}

/* CINEMA SIDE CARD */
.cinema-card {
    background: white;
    border-radius: 14px;
    overflow: hidden;
    display: flex;
    transition: 0.3s ease;
}
.cinema-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}
.cinema-card img {
    width: 45%;
    object-fit: cover;
}
.cinema-text {
    padding: 18px;
    font-size: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}
.cinema-text p {
    color: #6b7280;
}

/* COLORFUL TABLE */
.cinema-table {
    overflow: hidden;
    font-size: 20px;
     width: 50%;
    height: 30px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
}
.cinema-table thead {
    background: linear-gradient(135deg, #6366f1, #9333ea);
    color: white;
}
.cinema-table tbody tr:hover {
    background: #f9f9fb;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .cinema-card {
        flex-direction: column;
    }
    .cinema-card img {
        width: 200%;
        height: 300px;
    }
}

</style>
@endsection

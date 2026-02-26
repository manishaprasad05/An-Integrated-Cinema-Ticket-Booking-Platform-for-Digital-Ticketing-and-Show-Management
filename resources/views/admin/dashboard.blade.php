@extends('layouts.admin')

@section('content')

<div class="container mt-4">

    <h2 class="mb-4 page-title fw-bold">Welcome To CinemaT Dashboard...</h2><br>

    <div class="row g-4">

        <!-- Movies Card -->
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow rounded-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Movies</h5>
                    <h2 class="fw-bold">{{ $movies }}</h2>
                </div>
            </div>
        </div>

        <!-- Bookings Card -->
        <div class="col-md-3">
            <div class="card text-white bg-success shadow rounded-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Bookings</h5>
                    <h2 class="fw-bold">{{ $bookings }}</h2>
                </div>
            </div>
        </div>

        <!-- Users Card -->
        <div class="col-md-3">
            <div class="card text-white bg-warning shadow rounded-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Users</h5>
                    <h2 class="fw-bold">{{ $users }}</h2>
                </div>
            </div>
        </div>

        <!-- Revenue Card -->
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow rounded-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Revenue</h5>
                    <h2 class="fw-bold">₹{{ $revenue }}</h2>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection

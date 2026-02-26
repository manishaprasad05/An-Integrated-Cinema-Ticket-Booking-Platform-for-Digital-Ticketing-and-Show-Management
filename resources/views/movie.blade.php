@extends('layouts.user')

@section('content')

<div class="container">

    <!-- SEARCH BAR -->
    <form class="search-bar" method="GET" action="{{ route('movie') }}">
        <input type="text" name="q" placeholder="Search movie" value="{{ request('q') }}">

        <select name="language">
            <option value="">Language</option>
            <option value="Hindi" {{ request('language')=='Hindi'?'selected':'' }}>Hindi</option>
            <option value="English" {{ request('language')=='English'?'selected':'' }}>English</option>
            <option value="Telugu" {{ request('language')=='Telugu'?'selected':'' }}>Telugu</option>
        </select>

        <select name="genre">
            <option value="">Genre</option>
            <option value="Action" {{ request('genre')=='Action'?'selected':'' }}>Action</option>
            <option value="Comedy" {{ request('genre')=='Comedy'?'selected':'' }}>Comedy</option>
            <option value="Romance" {{ request('genre')=='Romance'?'selected':'' }}>Romance</option>
            <option value="Horror" {{ request('genre')=='Horror'?'selected':'' }}>Horror</option>
        </select>

       <button type="submit" class="user-btn">Search</button>

<a href="{{ route('movie') }}" class="all-btn">Show All</a>


    </form>

    @if($movies->count() > 0)

        <div class="movie-grid">
            @foreach($movies as $movie)
                <div class="movie-card">

                    <img src="{{ asset('storage/posters/'.$movie->poster) }}"
                         alt="{{ $movie->title }}"
                         style="width:100%;height:350px;object-fit:cover;border-radius:10px;">

                    <h3>{{ $movie->title }}</h3>

                    <p class="movie-meta">
                        <x-heroicon-s-star class="star-icon" />
                        {{ $movie->rating }} |
                        {{ $movie->language }} |
                        {{ $movie->genre }}
                    </p>

                    <a href="{{ route('movie.details', $movie->id) }}" class="user-btn">
                        Book Now
                    </a>

                </div>
            @endforeach
        </div>

    @else

        <div class="no-movie-message">
            <x-heroicon-s-film class="no-movie-icon" />
            <br><br><span>No movies found</span>
        </div>

    @endif

</div>

@endsection

@extends('layouts.user')

@section('content')

<div class="movie-details-container">

    <!-- 🎬 MOVIE INFO -->
    <div class="movie-info">

        <img src="{{ asset('storage/posters/'.$movie->poster) }}" class="movie-poster">

        <h2 class="movie-title">
            <x-heroicon-o-film class="icon-lg" />
            {{ $movie->title }}
        </h2>

        <p><x-heroicon-o-tag class="icon-sm" /> {{ $movie->genre }} | <x-heroicon-o-language class="icon-sm" /> {{ $movie->language }}</p>
       <p>
    <x-heroicon-o-star class="icon-sm" style="fill:#facc15; stroke:#facc15;" />

    {{ $movie->rating }}/5
</p>

        <p class="movie-desc">{{ $movie->description }}</p>

        <!-- 🎥 WATCH TRAILER -->
        @if(!empty($movie->trailer_url))
        <button type="button" class="trailer-btn" onclick="openTrailer()">
            <x-heroicon-o-play class="icon-sm" />
            Watch Trailer
        </button>
        @endif

    </div>


    <!-- 🎟 SCREEN / SHOW -->
    <div class="seat-booking">

        <h3 class="section-title">
            <x-heroicon-o-tv class="icon-sm" />
            Select Screen & Show
        </h3>

        <form action="{{ route('seat.page', $movie->id) }}" method="GET">

            <!-- SCREEN -->
            <label class="label-title">
                <x-heroicon-o-rectangle-group class="icon-sm" />
                Screen
            </label>

            <select name="screen" id="screenSelect" required onchange="updateShowTimes()">
                <option value="">-- Select Screen --</option>
                <option value="Screen 1">Screen 1</option>
                <option value="Screen 2">Screen 2</option>
                <option value="Screen 3">Screen 3</option>
            </select>

            <br>

            <!-- SHOW TIME -->
            <label class="label-title">
                <x-heroicon-o-clock class="icon-sm" />
                Show Time
            </label>

            <select name="show_time" id="showTimeSelect" required>
                <option value="">-- Select Show Time --</option>
            </select>
                <br><br><span class="price-badge">
                     <x-heroicon-o-currency-rupee class="icon-sm price-icon" />
    ₹ {{ number_format($movie->price, 2) }} per ticket

</span>

            <br><br>

            <!-- BUTTONS -->
            <div class="btn-group">

                <a href="{{ url()->previous() }}" class="back-btn">
                    <x-heroicon-o-arrow-left class="icon-sm" />
                    Back
                </a>

                <button type="submit" class="seatbtn">
                    <x-heroicon-o-ticket class="icon-sm" />
                    Proceed to Seats
                </button>

            </div>

        </form>
    </div>

</div>


<!-- 🎬 TRAILER MODAL -->
@if(!empty($movie->trailer_url))
<div id="trailerModal" class="modal">
    <div class="modal-content">

        <span class="close-btn" onclick="closeTrailer()">✖</span>

        <iframe id="trailerFrame"
                width="100%"
                height="350"
                src=""
                frameborder="0"
                allowfullscreen>
        </iframe>

    </div>
</div>
@endif


<!-- ✅ STYLES -->
<style>

/* ICON SIZE FIX */
svg {
    width: 18px !important;
    height: 18px !important;
}

.icon-lg {
    width: 22px !important;
    height: 22px !important;
}

/* LAYOUT */
.movie-details-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
    padding: 20px;
}

/* MOVIE INFO */
.movie-info {
    background: white;
    padding: 20px;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,.12);
}
.price-badge {
    background: #dcfce7;
    color: #166534;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    display: inline-block;
    margin-top: 8px;
}


.movie-poster {
    width: 100%;
    border-radius: 14px;
    margin-bottom: 12px;
}

.movie-title {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 6px;
}

.movie-desc {
    margin-top: 10px;
    line-height: 1.6;
}

/* BOOKING CARD */
.seat-booking {
    background: white;
    padding: 22px;
    border-radius: 16px;
    box-shadow: 0 8px 25px rgba(0,0,0,.12);
}

.section-title {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 12px;
}

.label-title {
    display: flex;
    align-items: center;
    gap: 6px;
    font-weight: 600;
    margin-top: 12px;
}

/* SELECT */
select {
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

/* BUTTON GROUP */
.btn-group {
    display: flex;
    justify-content: space-between;
    margin-top: 18px;
}

/* BUTTONS */
.back-btn {
    padding: 10px 18px;
    background: #6b7280;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
}


.seatbtn {
    padding: 10px 18px;
    border: none;
    background:#28a745;
    color: white;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
}

.trailer-btn {
    margin-top: 15px;
    padding: 10px 18px;
    border: none;
    background: red;
    color: white;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* MODAL */
.modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.8);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background: white;
    padding: 15px;
    border-radius: 14px;
    width: 70%;
    max-width: 700px;
    position: relative;
}

.close-btn {
    position: absolute;
    top: 8px;
    right: 12px;
    font-size: 22px;
    cursor: pointer;
}

/* MOBILE */
@media(max-width: 900px) {
    .movie-details-container {
        grid-template-columns: 1fr;
    }
}

</style>


<!-- ✅ SCRIPT -->
<script>
const screenShowTimes = {
    "Screen 1": ["9:00 AM", "12:00 PM", "3:00 PM"],
    "Screen 2": ["10:30 AM", "2:00 PM", "6:30 PM"],
    "Screen 3": ["11:00 AM", "4:00 PM", "9:30 PM"]
};

function updateShowTimes() {
    let screen = document.getElementById("screenSelect").value;
    let showTimeSelect = document.getElementById("showTimeSelect");

    showTimeSelect.innerHTML = "<option value=''>-- Select Show Time --</option>";

    if (screenShowTimes[screen]) {
        screenShowTimes[screen].forEach(time => {
            let option = document.createElement("option");
            option.value = time;
            option.textContent = time;
            showTimeSelect.appendChild(option);
        });
    }
}

function openTrailer() {
    let modal = document.getElementById("trailerModal");
    let frame = document.getElementById("trailerFrame");

    frame.src = "{{ $movie->trailer_url }}";
    modal.style.display = "flex";
}

function closeTrailer() {
    let modal = document.getElementById("trailerModal");
    let frame = document.getElementById("trailerFrame");

    frame.src = "";
    modal.style.display = "none";
}
</script>

@endsection

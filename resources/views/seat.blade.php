@extends('layouts.user')

@section('content')

<div class="seat-container">

    <h2 class="seat-title">
        <x-heroicon-o-film class="icon-lg" />
        {{ $movie->title }} — Seat Selection
    </h2>

    <p class="show-info">
        <x-heroicon-o-tv class="icon-sm" />
        Screen: <b>{{ request('screen') }}</b>
        &nbsp; | &nbsp;
        <x-heroicon-o-clock class="icon-sm" />
        Show Time: <b>{{ request('show_time') }}</b>
    </p>

    <div class="seat-legend">
        <span class="legend available"></span> Available
        <span class="legend booked"></span> Booked
        <span class="legend selected"></span> Selected
    </div>

    @php
        $booked = [];
        foreach($bookedSeats as $seatStr){
            $booked = array_merge($booked, explode(',', $seatStr));
        }

        $rows = ['A','B','C','D','E','F','G','H','I'];
        $totalSeatsPerRow = 34;
        $seatsPerLine = 17;
    @endphp

    <form method="POST" action="{{ route('book') }}" id="bookingForm">
        @csrf

        <input type="hidden" name="movie_id" value="{{ $movie->id }}">
        <input type="hidden" name="screen" value="{{ request('screen') }}">
        <input type="hidden" name="show_time" value="{{ request('show_time') }}">

        <div class="seat-grid">

            @foreach($rows as $row)

                <div class="row-label">
                    <x-heroicon-o-bars-3-bottom-left class="icon-sm" />
                    Row {{ $row }}
                </div>

                <div class="row-seats">

                    @for($i = 1; $i <= $totalSeatsPerRow; $i++)

                        @php
                            $seat = $row.$i;
                            $isBooked = in_array($seat, $booked);
                        @endphp

                        <div
                            class="seat-box {{ $isBooked ? 'booked' : 'available' }}"
                            data-seat="{{ $seat }}"
                            onclick="{{ $isBooked ? '' : 'toggleSeat(this)' }}"
                        >
                            {{ $seat }}
                        </div>

                        @if($i % $seatsPerLine == 0 && $i != $totalSeatsPerRow)
                            </div>
                            <div class="row-seats">
                        @endif

                    @endfor

                </div>

            @endforeach

        </div>

        <div class="seat-action">
            <a href="{{ url()->previous() }}" class="back-btn">
                <x-heroicon-o-arrow-left class="icon-sm" />
                Back
            </a>

            <button type="button" id="confirmBookingBtn" class="booking-btn">
                <x-heroicon-o-check-circle class="icon-sm" />
                Confirm Booking
            </button>
        </div>

    </form>

</div>

<!-- BOOKING SUCCESS POPUP -->
<div class="booking-popup" id="bookingPopup">
    <div class="booking-box">
        <div class="booking-check">
    <x-heroicon-s-sparkles class="success-icon" />
</div>
        <h3>Booking Confirmed!</h3>
        <p>Your seats have been reserved successfully.</p>
        <p>Now Pay</p>
    </div>
</div>

<style>
    .success-icon{
    width:60px !important;
    height:60px !important;
    color:#28a745;
    animation: popScale .6s ease;
}

@keyframes popScale{
    0%{ transform:scale(0); }
    70%{ transform:scale(1.2); }
    100%{ transform:scale(1); }
}


/* ICON FIX */
svg { width:18px !important; height:18px !important; }
.icon-lg { width:22px !important; height:22px !important; }

/* Wrapper */
.seat-container{
    max-width:1100px;
    margin:40px auto;
    background:#fff;
    padding:30px;
    border-radius:14px;
    box-shadow:0 10px 25px rgba(0,0,0,0.08);
}

/* Titles */
.seat-title{
    text-align:center;
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
}

.show-info{
    text-align:center;
    margin-bottom:20px;
    font-weight:600;
    display:flex;
    justify-content:center;
    gap:8px;
    flex-wrap:wrap;
}

/* Legend */
.seat-legend{
    text-align:center;
    margin-bottom:25px;
    font-weight:600;
}
.legend{
    display:inline-block;
    width:14px;
    height:14px;
    border-radius:4px;
    margin:0 6px 0 16px;
}
.legend.available{background:#1e90ff;}
.legend.booked{background:#dc3545;}
.legend.selected{background:#ffc107;}

/* Grid */
.seat-grid{ display:flex; flex-direction:column; gap:20px; }

.row-label{
    font-weight:700;
    margin-top:10px;
}

.row-seats{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
    margin-bottom:8px;
}

.seat-box{
    width:42px;
    height:42px;
    border-radius:8px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-weight:600;
    cursor:pointer;
    transition:.15s ease;
}

.available{ background:#1e90ff; color:#fff; }
.available:hover{ transform:scale(1.05); background:#2563eb; }
.booked{ background:#dc3545; color:#fff; cursor:not-allowed; }
.selected{ background:#ffc107 !important; color:#000; }

.seat-action{
    margin-top:30px;
    display:flex;
    justify-content:center;
    gap:15px;
}

.back-btn{
    padding:10px 18px;
    background:#6b7280;
    color:white;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
}

.booking-btn{
    background:#28a745;
    color:white;
    padding:12px 22px;
    border:none;
    border-radius:8px;
    cursor:pointer;
    font-weight:600;
    font-size:18px;
}

/* POPUP */
.booking-popup{
    position:fixed;
    inset:0;
    background:rgba(0,0,0,.6);
    display:flex;
    justify-content:center;
    align-items:center;
    opacity:0;
    pointer-events:none;
    transition:.3s ease;
    z-index:999;
}
.booking-popup.active{
    opacity:1;
    pointer-events:auto;
}

.booking-box{
    background:white;
    padding:35px 45px;
    border-radius:18px;
    text-align:center;
    transform:scale(.7);
    animation:popIn .4s ease forwards;
}
@keyframes popIn{
    to{ transform:scale(1); }
}

.booking-check{
    font-size:55px;
    margin-bottom:10px;
    animation:bounce .6s ease;
}
@keyframes bounce{
    0%{transform:scale(0);}
    60%{transform:scale(1.2);}
    100%{transform:scale(1);}
}

</style>

<script>

let selectedSeats = [];
const form = document.getElementById('bookingForm');
const confirmBtn = document.getElementById('confirmBookingBtn');

function toggleSeat(el){

    const seat = el.dataset.seat;

    if(selectedSeats.includes(seat)){
        selectedSeats = selectedSeats.filter(s => s !== seat);
        el.classList.remove('selected');
    } else {
        selectedSeats.push(seat);
        el.classList.add('selected');
    }

    document.querySelectorAll('input[name="seats[]"]').forEach(e => e.remove());

    selectedSeats.forEach(seat => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'seats[]';
        input.value = seat;
        form.appendChild(input);
    });
}

confirmBtn.addEventListener('click', function(){

    if(selectedSeats.length === 0){
        alert("Please select at least one seat.");
        return;
    }

    const popup = document.getElementById('bookingPopup');
    popup.classList.add('active');

    setTimeout(() => {
        form.submit();
    }, 2000);
});

</script>

@endsection

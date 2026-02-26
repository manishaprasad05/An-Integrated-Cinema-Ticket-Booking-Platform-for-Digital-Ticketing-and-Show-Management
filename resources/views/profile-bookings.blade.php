@extends('layouts.user')

@section('content')

<div class="profile-container">

    <!-- Page Title -->
    <h1 class="profile-title d-flex justify-content-center align-items-center gap-2" style="font-size: 38px;">

        <x-heroicon-o-ticket class="icon" />
        My Bookings
    </h1>

    @if($bookings->count() > 0)

        @foreach($bookings as $booking)

        <div class="booking-card">

            <!-- LEFT -->
            <div class="booking-left">

                <!-- Movie Name -->
                <h2 class="movie-name d-flex align-items-center gap-2">
                    <x-heroicon-o-film class="icon-sm" />
                    {{ $booking->movie->title }}
                </h2><br>

                <p><b>Screen:</b> {{ $booking->screen }}</p><br>
                <p><b>Show Time:</b> {{ $booking->show_time }}</p><br>
                <p><b>Seats:</b> {{ $booking->seats }}</p><br>
                <p><b>Total Paid:</b> ₹{{ $booking->total }}</p><br>
<p><b>Payment:</b>
    @if($booking->payment_method)
        {{ strtoupper($booking->payment_method) }}
    @elseif($booking->status == 'paid')
        ONLINE
    @else
        CASH
    @endif
</p><br>



               <!-- Status -->
<p>
    <b>Status:</b>

   @if($booking->payment_method == 'online')
    @if($booking->refund_status == 'pending')
        <span class="refund pending">
            Refund Pending (Admin Approval)
        </span>

    @elseif($booking->refund_status == 'refunded')
        <span class="refund refunded">
            Refund Completed ₹{{ $booking->refund_amount }}
        </span>

    @elseif($booking->refund_status == 'rejected')
        <span class="refund rejected">
            Refund Rejected (Show time over)
        </span>
    @endif
@endif

</p>


                <!-- ⭐ USER RATING -->
                <div class="rating-box">

    <br><b>Rating:</b>

    <div class="rating-stars-area">

        @if($booking->rating)
            <!-- SHOW SAVED RATING -->
            <span class="stars-display">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $booking->rating)
                        ★
                    @else
                        ☆
                    @endif
                @endfor
            </span>

            <div class="feedback-text mt-2">
                <b>My Feedback:</b> {{ $booking->feedback }}
            </div>

        @else
            <!-- RATING FORM -->
            <form action="{{ route('booking.rate', $booking->id) }}" method="POST" class="rating-form">
                @csrf

                <div class="star-input">
                    @for($i = 5; $i >= 1; $i--)
                        <input type="radio" name="rating" id="star{{ $i }}-{{ $booking->id }}" value="{{ $i }}" required>
                        <label for="star{{ $i }}-{{ $booking->id }}">★</label>
                    @endfor
                </div>

                <textarea name="feedback" placeholder="Write your feedback..." required></textarea>

                <button type="submit" class="btn rate-btn">
                    Submit Rating
                </button>
            </form>
        @endif

    </div>

</div>


                <!-- ACTIONS -->
                <div class="booking-actions">

                    @if($booking->status == 'paid')
                        <a href="{{ route('ticket.download', $booking->id) }}" class="btn download-btn">
                            <x-heroicon-o-arrow-down-tray class="icon-sm" />
                            Download Ticket
                        </a>
                    @endif

                    @if($booking->status != 'cancelled')
                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" onsubmit="return confirmCancel()">
                            @csrf
                            @method('PUT')

                            <button type="submit" class="btn cancel-btn">
                                <x-heroicon-o-x-circle class="icon-sm" />
                                Cancel Booking
                            </button>
                        </form>
                    @else
                        <span class="cancelled-text">Booking Cancelled!</span>
                    @endif

                </div>

            </div>

            <!-- RIGHT IMAGE -->
            <div class="booking-right">
                <img src="{{ asset('storage/posters/' . $booking->movie->poster) }}"
     alt="Poster"
     onerror="this.src='{{ asset('storage/posters/default.jpg') }}'">


            </div>

        </div>

        @endforeach

    @else
        <p class="no-booking">No bookings found!</p>
    @endif

</div>

<script>
function confirmCancel() {
    return confirm("Are you sure you want to cancel this booking?");
}
</script>

<style>


/* ICON */
.icon { width: 35px; height: 35px;  stroke: black !important;
    color: black !important;}
.icon-sm { width: 18px; height: 18px; }

/* BASE */
.profile-container {
    max-width: 1150px;
    margin: 45px auto;
    padding: 20px;
    font-family: "Poppins", sans-serif;
}

/* TITLE */
.profile-title {
    text-align: center;
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 30px;
}
.refund.rejected {
    color: #ef4444;
    font-weight: 700;
    margin-left: 10px;
}

/* CARD */
.booking-card {
    background: white;
    padding: 26px;
    border-radius: 18px;
    margin: 0 auto 22px auto;
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
    display: flex;
    justify-content: space-between;
    gap: 30px;
    max-width: 920px;
    width: 100%;
    transition: 0.3s ease;
    border-left: 6px solid #6366f1;
    align-items: center;
}

.booking-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 45px rgba(0,0,0,0.18);
}

/* LEFT */
.booking-left {
    flex: 1;
}

/* IMAGE — BIGGER */
.booking-right img {
    width: 190px;
    height: 270px;
    border-radius: 18px;
    object-fit: cover;
    background: #f3f4f6;
    box-shadow: 0 12px 30px rgba(0,0,0,0.3);
    transition: transform 0.3s ease;
}

.booking-right img:hover {
    transform: scale(1.06);
}

/* STATUS */
.status {
    padding: 6px 14px;
    border-radius: 10px;
    font-weight: bold;
    font-size: 13px;
}

.status.paid { background: #22c55e; color: white; }
.status.pending { background: #facc15; color: black; }
.status.cancelled { background: #ef4444; color: white; }

/* RATING */

.rating-stars-area {
    margin-top: 6px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.stars-display {
    font-size: 22px;
    color: #facc15;
    letter-spacing: 3px;
}

/* Keep star input same visual position */
.star-input {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-start;
    gap: 4px;
}




.star-input input { display: none; }

.star-input label {
    font-size: 22px;
    color: #d1d5db;
    cursor: pointer;
    transition: 0.2s;
}

.star-input input:checked ~ label,
.star-input label:hover,
.star-input label:hover ~ label {
    color: #facc15;
}

.feedback-text {
    font-size: 15px;
    color: #6b7280;
}

/* FEEDBACK */
.rating-form textarea {
    width: 100%;
    margin-top: 8px;
    padding: 10px;
    border-radius: 10px;
    border: 1px solid #ddd;
    font-size: 14px;
}

/* BUTTONS */
.booking-actions {
    margin-top: 16px;
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
}

.btn {
    padding: 10px 18px;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
}

/* DOWNLOAD */
.download-btn { background: #facc15; }

/* CANCEL */
.cancel-btn { background: #ef4444; color: white; }

/* RATE */
.rate-btn { background: #6366f1; color: white; margin-top: 8px; }

/* EMPTY */
.no-booking {
    text-align: center;
    font-size: 18px;
    color: #ef4444;
}
.cancelled-text {
    color: #ef4444; /* RED */
    font-weight: 700;
    font-size: 15px;
}
/* REFUND STATUS */
.refund.pending {
    color: #f59e0b;
    font-weight: 700;
    margin-left: 10px;
}

.refund.refunded {
    color: #22c55e;
    font-weight: 700;
    margin-left: 10px;
}


/* MOBILE */
@media (max-width: 768px) {
    .booking-card {
        flex-direction: column;
        text-align: center;
    }

    .booking-right img {
        width: 240px;
        height: 340px;
        border-radius: 18px;
        box-shadow: 0 14px 35px rgba(0,0,0,0.35);
    }

    .rating-form textarea {
        width: 100%;
    }
}

</style>

@endsection 
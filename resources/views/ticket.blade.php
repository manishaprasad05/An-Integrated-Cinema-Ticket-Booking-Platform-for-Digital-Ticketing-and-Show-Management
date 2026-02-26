@extends('layouts.user')

@section('content')
<div class="ticket-wrapper">
    <div class="ticket-card">

        <h2 class="ticket-title">🎟 Movie Ticket</h2>

        <div class="ticket-row">
            <span>Name :</span>
            <span>{{ $booking->user->name }}</span>
        </div>

        <div class="ticket-row">
            <span>Movie Name :</span>
            <span>{{ $booking->movie->title }}</span>
        </div>

        <div class="ticket-row">
            <span>Screen :</span>
            <span>{{ $booking->screen }}</span>
        </div>

        <div class="ticket-row">
            <span>Show Time :</span>
            <span>{{ $booking->show_time }}</span>
        </div>

        <div class="ticket-row">
            <span>Seats :</span>
            <span>{{ $booking->seats }}</span>
        </div>

        <div class="ticket-row total">
            <span>Amount Paid :</span>
            <span>₹{{ $booking->total }}</span>
        </div>

        <div class="qr-box">
            {!! QrCode::size(160)->generate('BOOKING-ID-'.$booking->id) !!}
        </div>

        <div class="status">
            ✅ Booking Confirmed
        </div>

        <!-- Download Button -->
        <a href="{{ route('ticket.download', $booking->id) }}" class="download-btn">
            ⬇ Download Ticket
        </a>

    </div>
</div>

<style>
    /* Back Button Style */
.back-btn {
    display: inline-block;
    margin-bottom: 15px;
    padding: 8px 15px;
   background:#28a745;
    color: white;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
}

.back-btn:hover {
    background: #374151;
}
/* Wrapper */
.ticket-wrapper{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:40px 15px;
}


/* Card */
.ticket-card{
    width:100%;
    max-width:420px;
    background:#fff;
    border-radius:18px;
    padding:26px;
    box-shadow:0 12px 32px rgba(0,0,0,.12);
}

/* Title */
.ticket-title{
    text-align:center;
    margin-bottom:22px;
    font-size:22px;
    font-weight:700;
}

/* Rows */
.ticket-row{
    display:flex;
    justify-content:space-between;
    padding:9px 0;
    font-size:15px;
    border-bottom:1px dashed #ddd;
}

.ticket-row span:first-child{
    font-weight:600;
    color:#555;
}

.ticket-row span:last-child{
    color:#000;
}

/* Amount */
.ticket-row.total{
    font-size:16px;
    font-weight:700;
    border-bottom:none;
    margin-top:12px;
}

/* QR */
.qr-box{
    display:flex;
    justify-content:center;
    margin:22px 0;
}

/* Status */
.status{
    text-align:center;
    background:#e9f9ef;
    color:#1e7e34;
    padding:10px;
    border-radius:8px;
    font-weight:600;
}

/* Download Button */
.download-btn{
    display:block;
    margin-top:16px;
    padding:12px;
    background:#ffc107;
    color:#000;
    text-align:center;
    border-radius:10px;
    font-weight:700;
    text-decoration:none;
    transition:.2s;
}

.download-btn:hover{
    background:#e0a800;
}

/* Mobile */
@media(max-width:480px){
    .ticket-card{
        padding:20px;
    }

    .ticket-row{
        font-size:14px;
    }

    .ticket-title{
        font-size:20px;
    }
}
</style>
@endsection

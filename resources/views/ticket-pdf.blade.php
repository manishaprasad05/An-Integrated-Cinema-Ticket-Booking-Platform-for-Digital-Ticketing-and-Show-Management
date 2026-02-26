<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cinema Ticket</title>

<style>

body{
    font-family: Arial, sans-serif;
    background:#f4f6f8;
    margin:0;
    padding:0;
}

/* Wrapper */
.ticket-wrapper{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    padding:20px;
}

/* Ticket Card */
.ticket-card{
    width:100%;
    max-width:420px;
    background:#ffffff;
    border-radius:18px;
    padding:25px;
    box-shadow:0 12px 30px rgba(0,0,0,0.15);
    position:relative;
}

/* Cinema Header */
.theater-header{
    text-align:center;
}

.theater-logo{
    width:60px;
    margin-bottom:5px;
}

.theater-name{
    margin:0;
    font-size:22px;
    font-weight:700;
}

.theater-tagline{
    font-size:12px;
    color:#666;
    margin-bottom:10px;
}

/* Divider */
.divider{
    border-top:1px dashed #bbb;
    margin:15px 0;
}

/* Title */
.ticket-title{
    text-align:center;
    font-size:18px;
    font-weight:bold;
    margin-bottom:15px;
}

/* Ticket Rows */
.ticket-row{
    display:flex;
    justify-content:space-between;
    padding:8px 0;
    font-size:14px;
    border-bottom:1px dashed #ddd;
}

.ticket-row.total{
    font-weight:bold;
    border-bottom:none;
    margin-top:10px;
}

/* QR */
.qr-box{
    text-align:center;
    margin:18px 0;
}

/* Status */
.status{
    text-align:center;
    background:#e9f9ef;
    color:#1e7e34;
    padding:8px;
    border-radius:6px;
    font-weight:600;
}

/* Footer */
.footer{
    text-align:center;
    font-size:12px;
    margin-top:10px;
    color:#777;
}

</style>
</head>

<body>

<div class="ticket-wrapper">
<div class="ticket-card">

    <!-- 🎬 CINEMA HEADER -->
    <div class="theater-header">
        <!-- Change logo path if needed -->
     <img src="{{ storage_path('app/public/logo.jpeg') }}" class="logo">




        <h2 class="theater-name"> CinemaT Theater</h2>
        <p class="theater-tagline">Experience Movies Like Never Before</p>
    </div>

    <div class="divider"></div>

    <div class="ticket-title">MOVIE TICKET</div>

    <!-- Ticket Details -->
    <div class="ticket-row">
        <span><b>Name : </b></span>
        <span>{{ $booking->user->name }}</span>
    </div>

    <div class="ticket-row">
        <span><b>Movie Name : </b></span>
        <span>{{ $booking->movie->title }}</span>
    </div>

    <div class="ticket-row">
        <span><b>Screen : <b></span>
        <span>{{ $booking->screen }}</span>
    </div>

    <div class="ticket-row">
        <span><b>Show Time : </b></span>
        <span>{{ $booking->show_time }}</span>
    </div>

    <div class="ticket-row">
        <span><b>Seats : </b></span>
        <span>{{ $booking->seats }}</span>
    </div>

    <div class="ticket-row total">
        <span>Total</span>
        <span>Rs. {{ $booking->total }}</span>
    </div>

    <!-- QR CODE -->
    <div class="qr-box">
        {!! QrCode::size(130)->generate('BOOKING-ID-'.$booking->id) !!}
    </div>

    <div class="status">
        Booking Confirmed
    </div>

    <div class="footer">
        Thank you for choosing CinemaT Booking...
    </div>

</div>
</div>
<style>
.logo {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #ddd;
}
</style>
</body>
</html>

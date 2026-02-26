@extends('layouts.user')

@section('content')

<div class="payment-container">

    <form method="POST"
          action="{{ route('payment.process', $booking->id) }}"
          class="payment-card"
          id="paymentForm">
        @csrf

        <!-- TITLE -->
        <h2 class="payment-title">
            <x-heroicon-o-credit-card class="icon" />
            Secure Payment
        </h2>

        <!-- USER DETAILS -->
        <h4 class="section-title centered-title">
            <x-heroicon-o-user class="icon-sm" />
            User Details
        </h4>

        <input type="text"
               name="name"
               placeholder="Full Name"
               value="{{ auth()->user()->name }}"
               required>

        <input type="email"
               name="email"
               placeholder="Email Address"
               value="{{ auth()->user()->email }}"
               required>

        <input type="text"
               name="mobile"
               placeholder="Mobile Number"
               required>

        <!-- PAYMENT METHOD -->
        <h4 class="section-title centered-title">
            <x-heroicon-o-banknotes class="icon-sm" />
            Select Payment Method
        </h4>

        <div class="payment-methods">

            <label class="pay-option">
                <input type="radio" name="payment_method" value="online" checked>
                <span class="pay-icon">
                    <x-heroicon-o-credit-card class="icon-sm" />
                </span>
                <span class="pay-text">Debit / Credit Card</span>
            </label>

            <label class="pay-option">
                <input type="radio" name="payment_method" value="online">
                <span class="pay-icon">
                    <x-heroicon-o-device-phone-mobile class="icon-sm" />
                </span>
                <span class="pay-text">UPI (GPay / PhonePe)</span>
            </label>

            <label class="pay-option">
                <input type="radio" name="payment_method" value="cash">
                <span class="pay-icon">
                    <x-heroicon-o-banknotes class="icon-sm" />
                </span>
                <span class="pay-text">Pay at Counter (Cash)</span>
            </label>

        </div>

        <!-- CARD DETAILS -->
        <div class="card-box" id="cardBox">
            <input type="text" placeholder="Card Number (Demo)">
            <input type="text" placeholder="MM/YY">
            <input type="text" placeholder="CVV">
        </div>

        <!-- AMOUNT -->
        <p class="amount">
            <x-heroicon-o-currency-rupee class="icon-sm" />
            Total Amount: ₹{{ $booking->total }}
        </p>

        <!-- PAY BUTTON -->
        <button type="button" id="payButton" class="pay-btn">
            <x-heroicon-o-lock-closed class="icon-sm" />
            Pay Now
        </button><br>

        <!-- BACK BUTTON -->
        <a href="{{ url()->previous() }}" class="back-btn">
            <x-heroicon-o-arrow-left class="icon-sm" />
            Back
        </a>

    </form>

</div>

<!-- SUCCESS POPUP -->
<div class="success-popup" id="successPopup">
    <div class="success-box">
        <div class="checkmark">✔</div>
        <h3>Payment Successful 🎉</h3>
        <p>Your booking is confirmed!</p>
    </div>
</div>

<style>

/* HEROICON FIX */
svg { width:18px !important; height:18px !important; }
.payment-title svg { width:22px !important; height:22px !important; }

/* Layout */
.payment-container{
    min-height:80vh;
    display:flex;
    justify-content:center;
    align-items:center;
    padding:15px;
}

/* Card */
.payment-card{
    background:#fff;
    padding:25px;
    width:100%;
    max-width:500px;
    border-radius:16px;
    box-shadow:0 12px 35px rgba(0,0,0,.12);
}

/* Title */
.payment-title{
    display:flex;
    justify-content:center;
    align-items:center;
    gap:8px;
    margin-bottom:15px;
    font-weight:700;
}

/* Inputs */
.payment-card input{
    width:100%;
    padding:12px;
    margin-bottom:12px;
    border:1px solid #d1d5db;
    border-radius:8px;
    font-size:14px;
}

/* Payment Options */
.pay-option{
    display:grid;
    grid-template-columns:20px 32px 1fr;
    align-items:center;
    gap:10px;
    padding:12px;
    border:1px solid #e5e7eb;
    border-radius:10px;
    margin-bottom:10px;
    cursor:pointer;
    background:#f9fafb;
    transition:.2s ease;
}
.pay-option:hover{
    border-color:#28a745;
    background:#f0fff4;
}
.pay-option input{ accent-color:#28a745; }

.card-box{ margin-top:10px; }

.amount{
    font-size:18px;
    font-weight:700;
    margin:18px 0;
    display:flex;
    justify-content:center;
    align-items:center;
    gap:6px;
}

.pay-btn{
    width:100%;
    background:#28a745;
    color:white;
    padding:13px;
    font-size:16px;
    border:none;
    border-radius:12px;
    cursor:pointer;
    display:flex;
    justify-content:center;
    align-items:center;
    gap:6px;
}
.pay-btn:hover{ background:#218838; }

.back-btn{
    display:inline-block;
    padding:10px 18px;
    background:#6b7280;
    color:white;
    border-radius:8px;
    text-decoration:none;
    font-weight:600;
}

/* SUCCESS POPUP */
.success-popup{
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
.success-popup.active{
    opacity:1;
    pointer-events:auto;
}

.success-box{
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

.checkmark{
    font-size:55px;
    color:#28a745;
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
const radios = document.querySelectorAll('input[name="payment_method"]');
const cardBox = document.getElementById('cardBox');
const payButton = document.getElementById('payButton');
const successPopup = document.getElementById('successPopup');
const form = document.getElementById('paymentForm');

function toggleCardBox(){
    const selected = document.querySelector('input[name="payment_method"]:checked').value;
    cardBox.style.display = selected === "cash" ? "none" : "block";
}

radios.forEach(r => r.addEventListener('change', toggleCardBox));
toggleCardBox();

/* Pay Now Animation */
payButton.addEventListener('click', function(){

    successPopup.classList.add('active');

    setTimeout(() => {
        form.submit();
    }, 2000);
});
</script>

@endsection

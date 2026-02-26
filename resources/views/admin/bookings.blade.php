@extends('layouts.admin')

@section('content')

<style>
/* Gradient Table Header */
.table thead th {
    background: linear-gradient(135deg, #4f46e5, #06b6d4);
    color: #ffffff !important;
    font-weight: 600;
    text-transform: uppercase;
    border-color: #2c2f36;
    font-size: 14px;
}

/* Responsive Improvements */
@media (max-width: 768px) {
    .page-title {
        font-size: 20px;
    }

    .title-icon {
        width: 26px;
        height: 26px;
    }

    table {
        font-size: 13px;
    }
}

/* Status Colors (Font Only) */
.status-paid {
    color: #22c55e;
    font-weight: 600;
}

.status-pending {
    color: #facc15;
    font-weight: 600;
}

.status-cancelled {
    color: #ef4444;
    font-weight: 600;
}
</style>

<div class="container-fluid mt-4">

    <!-- Page Title -->
    <div class="d-flex justify-content-center align-items-center flex-wrap gap-2 mb-4">

        <svg class="title-icon" xmlns="http://www.w3.org/2000/svg"
             fill="none" width="32" height="32"
             stroke="currentColor" stroke-width="2"
             viewBox="0 0 24 24">
            <rect x="3" y="8" width="18" height="13" rx="2"/>
            <path d="M16 3v5M8 3v5"/>
        </svg>

        <h2 class="mb-0 page-title fw-bold">All Bookings</h2>

    </div>

    <!-- Responsive Table -->
    <div class="table-responsive shadow rounded-3">
        <table class="table table-dark table-hover table-bordered align-middle text-center mb-0">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Movie Name</th>
                    <th>Seats</th>
                    <th>Total Amount</th>
                    <th>Booking Status</th>
                    <th>Refund</th>
                </tr>
            </thead>

            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->movie->title }}</td>
                    <td>{{ $booking->seats }}</td>
                    <td>₹{{ $booking->total }}</td>

                    <!-- Status Font Color -->
                     <td class="
                    @if($booking->status == 'paid') text-success fw-bold
                    @elseif($booking->status == 'pending') text-warning fw-bold
                    @elseif($booking->status == 'cancelled') text-danger fw-bold
                    @else text-light
                    @endif ">
                    {{ ucfirst($booking->status) }}
                </td>


                    <td>

    {{-- If Cancelled & Refund Pending --}}
    @if($booking->status == 'cancelled' && $booking->refund_status == 'pending')

        <div class="d-flex justify-content-center gap-2">

            {{-- Approve Button --}}
            <form method="POST" action="{{ route('admin.refund.approve', $booking->id) }}">
                @csrf
                <button class="btn btn-success btn-sm">
                    Approve
                </button>
            </form>

            {{-- Reject Button --}}
            <form method="POST" action="{{ route('admin.refund.reject', $booking->id) }}">
                @csrf
                <button class="btn btn-danger btn-sm">
                    Reject
                </button>
            </form>

        </div>

    {{-- Already Refunded --}}
    @elseif($booking->refund_status == 'refunded')
        <span class="text-success fw-bold">Refunded</span>

    {{-- Refund Rejected --}}
    @elseif($booking->refund_status == 'rejected')
        <span class="text-danger fw-bold">Rejected</span>

    {{-- Not Applicable --}}
    @else
        <span class="text-secondary fw-semibold">N/A</span>
    @endif

</td>


                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection

<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * 🎟 Store booking and redirect to payment
     */
    public function store(Request $request)
    {
        $request->validate([
            'movie_id'  => 'required|exists:movies,id',
            'screen'    => 'required|string',
            'show_time' => 'required|string',
            'seats'     => 'required|array|min:1',
        ]);

        // Get movie price dynamically
        $movie = Movie::findOrFail($request->movie_id);

        $totalAmount = count($request->seats) * $movie->price;

        $booking = Booking::create([
            'user_id'   => Auth::id(),
            'movie_id'  => $request->movie_id,
            'screen'    => $request->screen,
            'show_time' => $request->show_time,
            'seats'     => implode(',', $request->seats),
            'total'     => $totalAmount,
            'status'    => 'pending',
            'refund_status' => null, // make sure column exists in DB
        ]);

        return redirect()->route('payment.page', $booking->id);
    }

    /**
     * 🎫 Show ticket
     */
    public function ticket(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status !== 'paid') {
            abort(403, 'Payment not completed');
        }

        return view('ticket', compact('booking'));
    }

    /**
     * ⬇ Download Ticket PDF
     */
    public function download(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status !== 'paid') {
            abort(403);
        }

        $pdf = Pdf::loadView('ticket-pdf', [
            'booking' => $booking
        ])->setPaper('a4', 'portrait');

        return $pdf->download('movie-ticket-' . $booking->id . '.pdf');
    }

    /**
     * 👤 User Bookings
     */
    public function myBookings()
    {
        $bookings = Booking::with('movie')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('profile-bookings', compact('bookings'));
    }

    /**
     * ❌ Cancel Booking
     */
    public function cancelBooking(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        if ($booking->status === 'cancelled') {
            return back()->with('error', 'Booking already cancelled.');
        }

        // If paid online → mark refund pending
        if ($booking->status === 'paid') {
            $booking->refund_status = 'pending';
        }

        $booking->status = 'cancelled';
        $booking->save();

        return back()->with('success', 'Booking cancelled successfully!');
    }

    /**
     * ⭐ Save Rating
     */
    public function rate(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'rating'   => 'required|integer|min:1|max:5',
            'feedback' => 'required|string|max:255',
        ]);

        $booking->rating   = $request->rating;
        $booking->feedback = $request->feedback;
        $booking->save();

        return back()->with('success', 'Thank you for your rating!');
    }

    /**
     * 👑 ADMIN – Show All Bookings
     */
    public function adminBookings()
    {
        $bookings = Booking::with(['user','movie'])
            ->latest()
            ->get();

        return view('admin.bookings', compact('bookings'));
    }

    /**
     * 💰 ADMIN – Approve Refund
     */
   public function approveRefund($id)
{
    $booking = Booking::findOrFail($id);

    if ($booking->status === 'cancelled' && $booking->refund_status === 'pending') {

        $booking->refund_status = 'refunded';
        $booking->refund_amount = $booking->total;
        $booking->refund_date   = now();
        $booking->save();
    }

    return back()->with('success', 'Refund Approved');
}

public function rejectRefund($id)
{
    $booking = Booking::findOrFail($id);

    if ($booking->status === 'cancelled' && $booking->refund_status === 'pending') {

        $booking->refund_status = 'rejected';
        $booking->refund_date   = now();
        $booking->save();

        return back()->with('success', 'Refund Rejected due to show time over.');
    }

    return back()->with('error', 'Invalid refund request.');
}


}

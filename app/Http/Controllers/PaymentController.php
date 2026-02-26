<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * 💳 Show Payment Page
     */
    public function show(Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        return view('payment', [
            'booking' => $booking,
            'movie'   => $booking->movie,
            'amount'  => $booking->total
        ]);
    }

    /**
     * 💳 Process Payment (ONLINE or CASH)
     */
    public function process(Request $request, Booking $booking)
    {
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'payment_method' => 'required|in:online,cash'
        ]);

        // Save payment method & update status
        $booking->update([
            'status' => 'paid',
            'payment_method' => $request->payment_method
        ]);

        return redirect()
            ->route('ticket', $booking->id)
            ->with('success', 'Payment successful 🎉');
    }
}

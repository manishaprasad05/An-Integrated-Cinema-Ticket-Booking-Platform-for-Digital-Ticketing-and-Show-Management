<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'movie_id',
        'screen',
        'show_time',
        'seats',
        'total',
        'status',
        'payment_method',

        // ✅ Add these
        'refund_status',
        'refund_amount',
        'refund_date',
        'rating',
        'feedback',
    ];

    /**
     * Booking belongs to User
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * Booking belongs to Movie
     */
    public function movie()
    {
        return $this->belongsTo(\App\Models\Movie::class);
    }
}

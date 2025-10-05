<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'room_id',
        'customer_name',
        'email',
        'phone',
        'check_in',
        'check_out',
        'total_nights',
        'base_price',
        'total_amount',
        'final_amount',
        'price_breakdown'
    ];

    protected $casts = [
        'price_breakdown' => 'array',
        'check_in' => 'date',
        'check_out' => 'date',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}

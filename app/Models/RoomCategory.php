<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RoomCategory extends Model
{
    protected $fillable = ['name', 'base_price', 'room_count'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function getPriceForDate($date)
    {
        $dayOfWeek = $date->dayOfWeek;
        $isWeekend = in_array($dayOfWeek, [5, 6]); // Friday (5) or Saturday (6)

        return $isWeekend
            ? $this->base_price * 1.2
            : $this->base_price;
    }
}

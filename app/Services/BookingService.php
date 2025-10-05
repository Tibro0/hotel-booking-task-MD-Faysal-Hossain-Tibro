<?php

namespace App\Services;

use App\Models\Room;
use App\Models\RoomCategory;
use Carbon\CarbonPeriod;
use Illuminate\Support\Collection;

class BookingService
{
    public function calculatePrice(RoomCategory $category, $checkIn, $checkOut)
    {
        $period = CarbonPeriod::create($checkIn, $checkOut);
        $totalNights = $period->count() - 1;

        $basePrice = 0;
        $priceBreakdown = [];

        foreach ($period as $date) {
            if ($date->lt($checkOut)) {
                $dailyPrice = $category->getPriceForDate($date);
                $basePrice += $dailyPrice;
                $priceBreakdown[] = [
                    'date' => $date->format('Y-m-d'),
                    'day' => $date->format('l'),
                    'price' => $dailyPrice,
                    'is_weekend' => in_array($date->dayOfWeek, [5, 6])
                ];
            }
        }

        $totalAmount = $basePrice;
        $discount = 0;

        // Apply 10% discount for 3 or more consecutive nights
        if ($totalNights >= 3) {
            $discount = $totalAmount * 0.1;
        }

        $finalAmount = $totalAmount - $discount;

        return [
            'total_nights' => $totalNights,
            'base_price' => $basePrice,
            'total_amount' => $totalAmount,
            'discount' => $discount,
            'final_amount' => $finalAmount,
            'price_breakdown' => $priceBreakdown,
        ];
    }

    public function getAvailableRooms($roomCategoryId, $checkIn, $checkOut)
    {
        return Room::where('room_category_id', $roomCategoryId)
            ->get()
            ->filter(function ($room) use ($checkIn, $checkOut) {
                return $room->isAvailableForDates($checkIn, $checkOut);
            });
    }

    public function getAvailableCategories($checkIn, $checkOut): Collection
    {
        $categories = RoomCategory::with('rooms')->get();

        return $categories->map(function ($category) use ($checkIn, $checkOut) {
            $availableRooms = $this->getAvailableRooms($category->id, $checkIn, $checkOut);
            $priceCalculation = $this->calculatePrice($category, $checkIn, $checkOut);

            return [
                'category' => $category,
                'available_rooms_count' => $availableRooms->count(),
                'is_available' => $availableRooms->count() > 0,
                'price_calculation' => $priceCalculation,
            ];
        });
    }

    public function getFullyBookedDates(): array
    {
        $dates = [];
        $categories = RoomCategory::all();

        // This is a simplified version - in production you'd want to cache this
        // and implement a more efficient query
        foreach ($categories as $category) {
            // Logic to find dates where all rooms in all categories are booked
            // For now, returning empty array - implement based on your needs
        }

        return $dates;
    }
}

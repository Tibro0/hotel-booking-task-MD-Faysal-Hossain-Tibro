<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $categories = [
            ['name' => 'Premium Deluxe', 'base_price' => 12000],
            ['name' => 'Super Deluxe', 'base_price' => 10000],
            ['name' => 'Standard Deluxe', 'base_price' => 8000],
        ];

        foreach ($categories as $categoryData) {
            $category = RoomCategory::create($categoryData);

            // Create 3 rooms for each category
            for ($i = 1; $i <= 3; $i++) {
                Room::create([
                    'room_category_id' => $category->id,
                    'room_number' => $category->name[0] . $i,
                ]);
            }
        }
    }
}

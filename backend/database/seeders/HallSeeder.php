<?php

namespace Database\Seeders;

use App\Models\Cinema;
use App\Models\Hall;
use Illuminate\Database\Seeder;

class HallSeeder extends Seeder
{
    public function run(): void
    {
        Cinema::each(function ($cinema) {
            $startNumber = Hall::where('cinema_id', $cinema->id)
                ->max('number') ?? 0;

            for ($i = 1; $i <= 3; $i++) {
                Hall::firstOrCreate(
                    [
                        'cinema_id' => $cinema->id,
                        'number' => $startNumber + $i
                    ],
                    [
                        'capacity' => 60,
                    ]
                );
            }
        });
    }
}

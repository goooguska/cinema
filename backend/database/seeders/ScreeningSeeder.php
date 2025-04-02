<?php

namespace Database\Seeders;

use App\Models\Hall;
use App\Models\Movie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ScreeningSeeder extends Seeder
{
    public function run(): void
    {
        Hall::each(function ($hall) {
            for ($i = 0; $i < 5; $i++) {
                $movie = Movie::inRandomOrder()->first();
                $start = Carbon::today()
                    ->addDays(rand(1, 30))
                    ->setTime(rand(9, 23), rand(0, 3) * 15);

                $hall->screenings()->create([
                    'movie_id' => $movie->id,
                    'start_time' => $start,
                    'end_time' => $start->copy()->addMinutes($movie->duration + 30)
                ]);
            }
        });
    }
}

<?php

namespace Database\Factories;

use App\Models\Hall;
use App\Models\Movie;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScreeningFactory extends Factory
{
    public function definition(): array
    {
        $startTime = Carbon::now()
            ->addDays(rand(1, 30))
            ->setHours(rand(9, 23))
            ->setMinutes(rand(0, 3) * 15);

        return [
            'hall_id' => Hall::factory(),
            'movie_id' => Movie::factory(),
            'start_time' => $startTime,
            'end_time' => $startTime->copy()->addMinutes(
                Movie::value('duration') + 30
            ),
        ];
    }
}

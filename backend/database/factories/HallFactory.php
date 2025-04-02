<?php

namespace Database\Factories;

use App\Models\Cinema;
use Illuminate\Database\Eloquent\Factories\Factory;

class HallFactory extends Factory
{
    public function definition(): array
    {
        return [
            'number' => 1,
            'capacity' => 60,
            'cinema_id' => Cinema::factory(),
        ];
    }
}

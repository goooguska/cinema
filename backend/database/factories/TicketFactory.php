<?php

namespace Database\Factories;

use App\Models\Cinema;
use App\Models\Screening;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    public function definition(): array
    {
        return [
            'price' => $this->faker->randomFloat(2, 5, 25),
            'status' => $this->faker->randomElement(['active', 'reserved']),
            'user_id' => User::factory(),
            'screening_id' => Screening::factory(),
        ];
    }
}

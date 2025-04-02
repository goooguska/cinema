<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CinemaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company.' Cinema',
            'address' => $this->faker->unique()->address,
        ];
    }
}

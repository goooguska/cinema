<?php

namespace Database\Factories;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                UserRoleEnum::ADMIN->value,
                UserRoleEnum::DEFAULT->value
            ]),
        ];
    }
}

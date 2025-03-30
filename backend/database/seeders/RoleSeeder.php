<?php

namespace Database\Seeders;

use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate([
            'name' => UserRoleEnum::ADMIN->value,
        ]);

        Role::firstOrCreate([
            'name' => UserRoleEnum::DEFAULT->value,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            CinemaSeeder::class,
            HallSeeder::class,
            ScreeningSeeder::class,
        ]);

        User::factory()->create([
             'name' => 'Test User',
             'phone' => '0123456789',
             'email' => 'test@example.com',
             'password' => Hash::make('password'),
             'role_id' => 1,
         ]);
    }
}

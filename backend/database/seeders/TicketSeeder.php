<?php

namespace Database\Seeders;

use App\Models\Screening;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    public function run(): void
    {
        Screening::each(function ($screening) {
            for ($seat = 1; $seat <= $screening->hall->capacity; $seat++) {
                Ticket::create([
                    'screening_id' => $screening->id,
                    'seat_number' => $seat,
                    'price' => rand(500, 2500) / 100,
                    'status' => 'active',
                    'user_id' => User::inRandomOrder()->first()->id,
                ]);
            }
        });
    }
}

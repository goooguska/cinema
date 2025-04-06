<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface TicketRepository
{
    public function getOccupiedSeats(int $screeningId): array;

    public function createBooking(array $data);

    public function getTicketsByUserId(string $userId): Collection;

}

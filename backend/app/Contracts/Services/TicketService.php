<?php

namespace App\Contracts\Services;

use Illuminate\Support\Collection;

interface TicketService
{
    public function getSeatInfo(int $screeningId);

    public function bookSeats(array $requestData);

    public function getTicketsByUserId(string $userId): Collection;
}

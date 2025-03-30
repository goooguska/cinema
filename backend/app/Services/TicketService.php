<?php

namespace App\Services;

use App\Contracts\Repositories\TicketRepository;
use App\Contracts\Services\TicketService as TicketServiceContract;

class TicketService implements TicketServiceContract
{
    public function __construct(private readonly TicketRepository $ticketRepository) {}

}

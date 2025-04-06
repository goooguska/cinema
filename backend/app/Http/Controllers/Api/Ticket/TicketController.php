<?php

namespace App\Http\Controllers\Api\Ticket;

use App\Contracts\Services\TicketService;
use App\Http\Controllers\Controller;
use App\Http\Presenters\Api\Ticket\TicketPresenter;
use App\Http\Requests\Ticket\GetTicketsRequest;

class TicketController extends Controller
{
    public function __construct(private readonly TicketService $ticketService) {}

    public function getTicketsByUserId(GetTicketsRequest $request): array
    {
        $userId = $request->input('user_id');

        $tickets = $this->ticketService->getTicketsByUserId($userId)->toArray();

        return TicketPresenter::make($tickets);
    }
}

<?php

namespace App\Http\Controllers\Api\Screening;

use App\Contracts\Services\TicketService;
use App\Http\Controllers\Controller;
use App\Models\Screening;

class ListController extends Controller
{
    public function __construct(private readonly TicketService $ticketService) {}

    public function getSeatInfo(Screening $screening)
    {
        return response()->json(
            $this->ticketService->getSeatInfo($screening->id)
        );
    }
}

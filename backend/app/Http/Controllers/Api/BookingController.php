<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\TicketService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function __construct(private readonly TicketService $ticketService) {}

    public function store(Request $request) {
        $validated = $request->validate([
            'screening_id' => 'required|exists:screenings,id',
            'seats' => 'required|array|min:1',
            'seats.*' => 'integer|min:1',
            'user_id' => 'required|exists:users,id'
        ]);

        try {
            $tickets = $this->ticketService->bookSeats($validated);

            return response()->json([
                'message' => 'Booking successful',
                'tickets' => $tickets
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 422);
        }
    }
}

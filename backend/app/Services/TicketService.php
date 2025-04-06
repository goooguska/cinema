<?php

namespace App\Services;

use App\Contracts\Repositories\TicketRepository;
use App\Contracts\Services\TicketService as TicketServiceContract;
use App\Models\Screening;
use Illuminate\Support\Collection;

class TicketService implements TicketServiceContract
{
    public function __construct(private readonly TicketRepository $ticketRepository) {}

    public function getSeatInfo(int $screeningId)
    {
        $screening = Screening::with('hall')->findOrFail($screeningId);
        $capacity = $screening->hall->capacity;

        return [
            'all_seats' => range(1, $capacity),
            'occupied' => $this->ticketRepository->getOccupiedSeats($screeningId),
            'price' => $screening->price,
            'capacity' => $capacity
        ];
    }

    public function bookSeats(array $requestData)
    {
        $screening = Screening::with('hall')->findOrFail($requestData['screening_id']);

        if (max($requestData['seats']) > $screening->hall->capacity) {
            throw new \InvalidArgumentException('Invalid seat numbers');
        }

        return $this->ticketRepository->createBooking($requestData);
    }

    public function getTicketsByUserId(string $userId): Collection
    {
       return $this->ticketRepository->getTicketsByUserId($userId);
    }
}

<?php

namespace App\Repositories;

use App\Contracts\Repositories\TicketRepository as TicketRepositoryContract;
use App\Models\Ticket;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TicketRepository extends BaseRepository implements TicketRepositoryContract
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }

    public function getOccupiedSeats(int $screeningId): array
    {
        return $this->getModel()->newQuery()
            ->where('screening_id', $screeningId)
            ->pluck('seat_number')
            ->toArray();
    }

    public function createBooking(array $data)
    {
        return DB::transaction(function () use ($data) {
            $tickets = [];
            foreach ($data['seats'] as $seat) {
                $tickets[] = $this->getModel()->insert([
                    'screening_id' => $data['screening_id'],
                    'user_id' => $data['user_id'],
                    'seat_number' => $seat,
                    'status' => 'reserved'
                ]);
            }
            return $tickets;
        });
    }

    public function getTicketsByUserId(string $userId): Collection
    {
        return $this->getModel()
            ->with('screening.movie')
            ->where('user_id', $userId)
            ->get();
    }
}

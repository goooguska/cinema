<?php

namespace App\Repositories;

use App\Contracts\Repositories\CinemaRepository as CinemaRepositoryContract;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Ticket;

class TicketRepository extends BaseRepository implements CinemaRepositoryContract
{
    public function __construct(Ticket $model)
    {
        parent::__construct($model);
    }
}

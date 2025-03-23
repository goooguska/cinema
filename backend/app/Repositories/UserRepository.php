<?php

namespace App\Repositories;

use App\Contracts\Repositories\CinemaRepository as CinemaRepositoryContract;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Ticket;
use App\Models\User;

class UserRepository extends BaseRepository implements CinemaRepositoryContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}

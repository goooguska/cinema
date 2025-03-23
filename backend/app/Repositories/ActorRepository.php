<?php

namespace App\Repositories;

use App\Contracts\Repositories\CinemaRepository as CinemaRepositoryContract;
use App\Models\Actor;
use App\Models\Cinema;

class ActorRepository extends BaseRepository implements CinemaRepositoryContract
{
    public function __construct(Actor $model)
    {
        parent::__construct($model);
    }
}

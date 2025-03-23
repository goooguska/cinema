<?php

namespace App\Repositories;

use App\Contracts\Repositories\CinemaRepository as CinemaRepositoryContract;
use App\Models\Cinema;
use App\Models\Hall;

class HallRepository extends BaseRepository implements CinemaRepositoryContract
{
    public function __construct(Hall $model)
    {
        parent::__construct($model);
    }
}

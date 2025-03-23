<?php

namespace App\Repositories;

use App\Contracts\Repositories\CinemaRepository as CinemaRepositoryContract;
use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Screening;

class ScreeningRepository extends BaseRepository implements CinemaRepositoryContract
{
    public function __construct(Screening $model)
    {
        parent::__construct($model);
    }
}

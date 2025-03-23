<?php

namespace App\Repositories;

use App\Contracts\Repositories\CinemaRepository as CinemaRepositoryContract;
use App\Models\Cinema;
use App\Models\Movie;

class MovieRepository extends BaseRepository implements CinemaRepositoryContract
{
    public function __construct(Movie $model)
    {
        parent::__construct($model);
    }
}

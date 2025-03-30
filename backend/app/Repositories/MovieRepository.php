<?php

namespace App\Repositories;

use App\Contracts\Repositories\MovieRepository as MovieRepositoryContract;
use App\Models\Movie;

class MovieRepository extends BaseRepository implements MovieRepositoryContract
{
    public function __construct(Movie $model)
    {
        parent::__construct($model);
    }
}

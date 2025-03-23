<?php

namespace App\Repositories;

use App\Contracts\Repositories\CinemaRepository as CinemaRepositoryContract;
use App\Models\Cinema;
use App\Models\Genre;

class GenreRepository extends BaseRepository implements CinemaRepositoryContract
{
    public function __construct(Genre $model)
    {
        parent::__construct($model);
    }
}

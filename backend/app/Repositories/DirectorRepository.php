<?php

namespace App\Repositories;

use App\Contracts\Repositories\CinemaRepository as CinemaRepositoryContract;
use App\Models\Cinema;
use App\Models\Director;

class DirectorRepository extends BaseRepository implements CinemaRepositoryContract
{
    public function __construct(Director $model)
    {
        parent::__construct($model);
    }
}

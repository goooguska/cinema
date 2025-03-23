<?php

namespace App\Repositories;

use App\Contracts\Repositories\CinemaRepository as CinemaRepositoryContract;
use App\Models\Cinema;

class CinemaRepository extends BaseRepository implements CinemaRepositoryContract
{
    public function __construct(Cinema $model)
    {
        parent::__construct($model);
    }
}

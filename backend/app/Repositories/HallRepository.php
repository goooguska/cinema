<?php

namespace App\Repositories;

use App\Contracts\Repositories\HallRepository as HallRepositoryContract;
use App\Models\Hall;

class HallRepository extends BaseRepository implements HallRepositoryContract
{
    public function __construct(Hall $model)
    {
        parent::__construct($model);
    }
}

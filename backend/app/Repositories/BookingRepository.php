<?php

namespace App\Repositories;

use App\Contracts\Repositories\BookingRepository as BookingRepositoryContract;
use App\Models\Actor;

class BookingRepository extends BaseRepository implements BookingRepositoryContract
{
    public function __construct(Actor $model)
    {
        parent::__construct($model);
    }
}

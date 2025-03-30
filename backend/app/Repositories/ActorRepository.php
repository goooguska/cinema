<?php

namespace App\Repositories;

use App\Contracts\Repositories\ActorRepository as ActorRepositoryContract;
use App\Models\Actor;

class ActorRepository extends BaseRepository implements ActorRepositoryContract
{
    public function __construct(Actor $model)
    {
        parent::__construct($model);
    }
}

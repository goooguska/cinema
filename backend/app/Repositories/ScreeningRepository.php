<?php

namespace App\Repositories;

use App\Contracts\Repositories\ScreeningRepository as ScreeningRepositoryContract;
use App\Models\Screening;

class ScreeningRepository extends BaseRepository implements ScreeningRepositoryContract
{
    public function __construct(Screening $model)
    {
        parent::__construct($model);
    }
}

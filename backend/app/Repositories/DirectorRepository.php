<?php

namespace App\Repositories;

use App\Contracts\Repositories\DirectorRepository as DirectorRepositoryContract;
use App\Models\Director;

class DirectorRepository extends BaseRepository implements
    DirectorRepositoryContract
{
    public function __construct(Director $model)
    {
        parent::__construct($model);
    }
}

<?php

namespace App\Repositories;

use App\Contracts\Repositories\GenreRepository as GenreRepositoryContract;
use App\Models\Genre;

class GenreRepository extends BaseRepository implements GenreRepositoryContract
{
    public function __construct(Genre $model)
    {
        parent::__construct($model);
    }
}

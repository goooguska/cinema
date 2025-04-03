<?php

namespace App\Repositories;

use App\Contracts\Repositories\MovieRepository as MovieRepositoryContract;
use App\Models\Movie;
use Illuminate\Support\Collection;

class MovieRepository extends BaseRepository implements MovieRepositoryContract
{
    public function __construct(Movie $model)
    {
        parent::__construct($model);
    }

    public function getMovies(): Collection
    {
        return $this->getModel()->with('genres')->get();
    }
}

<?php

namespace App\Contracts\Repositories;

use App\Models\Movie;
use Illuminate\Support\Collection;

interface MovieRepository
{
    public function getMovies(): Collection;

    public function findMovieById(int $id): ?Movie;

    public function getDailyMovies(string $date): Collection;
}

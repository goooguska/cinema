<?php

namespace App\Contracts\Services;

use App\Models\Movie;
use Illuminate\Support\Collection;

interface MovieService
{
    public function getMovies(): Collection;

    public function getMovieById(int $id): ?Movie;

    public function getDailyMovies(string $date): Collection;

    public function createMovie(array $fields): Movie;

    public function updateOrCreate(array $fields, array $values = []);
}

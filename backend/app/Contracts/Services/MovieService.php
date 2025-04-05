<?php

namespace App\Contracts\Services;

use App\Models\Movie;
use Illuminate\Support\Collection;

interface MovieService
{
    public function getMovies(): Collection;

    public function getMovieById(int $id): array;

    public function createMovie(array $fields): Movie;

    public function updateOrCreate(array $fields, array $values = []);
}

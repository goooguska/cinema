<?php

namespace App\Contracts\Services;

use App\Models\Movie;

interface MovieService
{
    public function createMovie(array $fields): Movie;

    public function updateOrCreate(array $fields, array $values = []);
}

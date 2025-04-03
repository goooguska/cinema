<?php

namespace App\Contracts\Repositories;

use Illuminate\Support\Collection;

interface MovieRepository
{
    public function getMovies(): Collection;
}

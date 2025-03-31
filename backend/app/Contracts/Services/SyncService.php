<?php

namespace App\Contracts\Services;

use App\Models\Movie;

interface SyncService
{
    public function syncMovie(Movie $movie, array $data): bool;
}

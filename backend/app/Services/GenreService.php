<?php

namespace App\Services;

use App\Contracts\Repositories\GenreRepository;
use App\Contracts\Services\GenreService as GenreServiceContract;
use App\Models\Genre;

class GenreService implements GenreServiceContract
{
    public function __construct(private readonly GenreRepository $genreRepository) {}

    public function updateOrCreate(array $fields)
    {
        return $this->genreRepository->updateOrCreate($fields);
    }
}

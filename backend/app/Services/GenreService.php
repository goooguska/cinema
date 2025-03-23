<?php

namespace App\Services;

use App\Contracts\Repositories\GenreRepository;
use App\Contracts\Services\GenreService as GenreServiceContract;

class GenreService implements GenreServiceContract
{
    public function __construct(private readonly GenreRepository $genreRepository) {}

}

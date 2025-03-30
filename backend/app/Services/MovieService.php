<?php

namespace App\Services;

use App\Contracts\Repositories\MovieRepository;
use App\Contracts\Services\MovieService as MovieServiceContract;

class MovieService implements MovieServiceContract
{
    public function __construct(private readonly MovieRepository $movieRepository) {}
}

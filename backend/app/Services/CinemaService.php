<?php

namespace App\Services;

use App\Contracts\Repositories\CinemaRepository;
use App\Contracts\Services\CinemaService as CinemaServiceContract;

class CinemaService implements CinemaServiceContract
{
    public function __construct(private readonly CinemaRepository $cinemaRepository) {}
}

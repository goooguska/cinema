<?php

namespace App\Services;

use App\Contracts\Repositories\CountryRepository;
use App\Contracts\Services\CountryService as CountryServiceContract;

class CountryService implements CountryServiceContract
{
    public function __construct(private readonly CountryRepository $directorRepository) {}

    public function updateOrCreate(array $fields)
    {
        return $this->directorRepository->updateOrCreate($fields);
    }
}

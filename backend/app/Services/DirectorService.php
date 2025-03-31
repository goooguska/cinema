<?php

namespace App\Services;

use App\Contracts\Repositories\DirectorRepository;
use App\Contracts\Services\DirectorService as DirectorServiceContract;

class DirectorService implements DirectorServiceContract
{
    public function __construct(private readonly DirectorRepository $directorRepository) {}

    public function updateOrCreate(array $fields)
    {
        return $this->directorRepository->updateOrCreate($fields);
    }
}

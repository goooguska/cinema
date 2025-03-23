<?php

namespace App\Services;

use App\Contracts\Repositories\ScreeningRepository;
use App\Contracts\Services\ScreeningService as ScreeningServiceContract;

class ScreeningService implements ScreeningServiceContract
{
    public function __construct(private readonly ScreeningRepository $screeningRepository) {}
}

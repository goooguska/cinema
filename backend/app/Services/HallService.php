<?php

namespace App\Services;

use App\Contracts\Repositories\HallRepository;
use App\Contracts\Services\HallService as HallServiceContract;

class HallService implements HallServiceContract
{
    public function __construct(private readonly HallRepository $hallRepository) {}
}

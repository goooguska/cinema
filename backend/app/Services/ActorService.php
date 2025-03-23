<?php

namespace App\Services;

use App\Contracts\Repositories\ActorRepository;
use App\Contracts\Services\ActorService as ActorServiceContract;

class ActorService implements ActorServiceContract
{
    public function __construct(private readonly ActorRepository $actorRepository) {}
}

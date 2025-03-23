<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepository;
use App\Contracts\Services\UserService as UserServiceContract;

class UserService implements UserServiceContract
{
    public function __construct(private readonly UserRepository $userRepository) {}

}

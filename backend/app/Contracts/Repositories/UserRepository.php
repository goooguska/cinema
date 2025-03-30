<?php

namespace App\Contracts\Repositories;

use App\Models\User;

interface UserRepository
{
    public function findUserByEmail(string $email): ?User;
}

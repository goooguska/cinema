<?php

namespace App\Repositories;

use App\Contracts\Repositories\UserRepository as UserRepositoryContract;
use App\Models\User;

class UserRepository extends BaseRepository implements UserRepositoryContract
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findUserByEmail(string $email): ?User
    {
        /** @var User|null $user */
        $user = $this->getModel()->newQuery()->where('email', $email)->first();

        return $user;
    }
}

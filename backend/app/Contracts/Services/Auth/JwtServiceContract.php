<?php

namespace App\Contracts\Services\Auth;

use App\Models\User;

interface JwtServiceContract
{
    public function fromUser(User $user): string;

    public function authenticate(): User;

    public function invalidate(): void;

    public function refresh(): string;

    public function user(): ?User;

    public function getTTL(): int;
}

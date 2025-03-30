<?php

namespace App\Contracts\Services;

use App\Http\Presenters\Api\Auth\AuthUserPresenter;
use App\Models\User;

interface UserService
{
    public function createNewUser(array $data): array;

    public function logout(): void;

    public function getCurrentUser(): ?User;

    public function authenticateUser(string $email, string $password): User;

    public function loginUser(array $credentials): array;

    public function refreshToken(): array;
}

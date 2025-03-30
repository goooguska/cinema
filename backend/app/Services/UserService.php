<?php

namespace App\Services;

use App\Contracts\Repositories\UserRepository;
use App\Contracts\Services\Auth\JwtServiceContract;
use App\Contracts\Services\UserService as UserServiceContract;
use App\Http\Presenters\Api\Auth\AuthUserPresenter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceContract
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly JwtServiceContract $jwtService
    ) {}

    public function createNewUser(array $data): array
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->userRepository->create($data);
        $token = $this->jwtService->fromUser($user);
        $ttl = $this->jwtService->getTTL();

        return AuthUserPresenter::make($user, $token, $ttl);
    }

    public function logout(): void
    {
        $this->jwtService->invalidate();
    }

    public function getCurrentUser(): ?User
    {
        return $this->jwtService->user();
    }

    public function loginUser(array $credentials): array
    {
        $user = $this->authenticateUser($credentials['email'], $credentials['password']);
        $token = $this->jwtService->fromUser($user);
        $ttl = $this->jwtService->getTTL();

        return AuthUserPresenter::make($user, $token, $ttl);
    }

    public function authenticateUser(string $email, string $password): User
    {
        $user = $this->findUserByEmail($email);

        if ($user === null) {
            throw new \DomainException('User not found', 404);
        }

        if (!Hash::check($password, $user->password)) {
            throw new \DomainException('Invalid password', 401);
        }

        return $user;
    }

    public function refreshToken(): array
    {
        try {
            $newToken = $this->jwtService->refresh();
            $user = $this->jwtService->user();
            $ttl = $this->jwtService->getTTL();

            return AuthUserPresenter::make($user, $newToken, $ttl);
        } catch (\DomainException $e) {
            throw new \DomainException('Token refresh failed', 401);
        }
    }

    private function findUserByEmail(string $email): ?User
    {
        return $this->userRepository->findUserByEmail($email);
    }
}

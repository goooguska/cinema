<?php

namespace App\Services\Auth;

use App\Contracts\Services\Auth\JwtServiceContract;
use App\Models\User;
use DomainException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTGuard;

class JwtService implements JwtServiceContract
{
    protected JWTGuard $guard;

    public function __construct()
    {
        $guard = auth('api');

        if (!$guard instanceof JWTGuard) {
            throw new \RuntimeException('Invalid guard configuration');
        }

        $this->guard = $guard;
    }

    public function authenticate(): User
    {
        if (!$user = $this->guard->user()) {
            throw new DomainException('User not found', 404);
        }

        return $user;
    }

    public function fromUser(User $user): string
    {
        return $this->guard->login($user);
    }

    public function invalidate(): void
    {
        try {
            $this->guard->logout();
        } catch (JWTException $e) {
            throw new DomainException('Token invalidation failed', 500);
        }
    }

    public function refresh(): string
    {
        try {
            $newToken = $this->guard->refresh();
            $this->guard->setToken($newToken);

            return $newToken;
        } catch (JWTException $e) {
            throw new DomainException('Token refresh failed', 401);
        }
    }

    public function getTTL(): int
    {
        return config('jwt.ttl') * 60;
    }

    public function user(): ?User
    {
        try {
            return $this->guard->user();
        } catch (JWTException $e) {
            throw new DomainException('User not found', 404);
        }
    }
}

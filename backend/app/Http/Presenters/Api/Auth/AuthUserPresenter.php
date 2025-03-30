<?php

namespace App\Http\Presenters\Api\Auth;

use App\Models\User;

class AuthUserPresenter
{
    public function __construct(
        private readonly User $user,
        private readonly string $token,
        private readonly int $ttl
    ) {}

    public static function make(User $user, string $token, int $ttl): array
    {
        return (new self($user, $token, $ttl))->present();
    }

    private function present(): array
    {
        return [
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'phone' => $this->user->phone
            ],
            'access_token' => $this->token,
            'token_type' => 'bearer',
            'expires_in' => $this->ttl
        ];
    }
}

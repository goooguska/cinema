<?php

namespace App\Http\Controllers\Api;

use App\Contracts\Services\UserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\CreateUserRequest;
use App\Http\Requests\Auth\LoginUserRequest;
use App\Models\User;
use DomainException;
use Illuminate\Http\JsonResponse;
use Throwable;

class AuthController extends Controller
{
    public function __construct(private readonly UserService $userService) {}

    public function createUser(CreateUserRequest $request)
    {
        try {
            $data = $request->all();
            $userData = $this->userService->createNewUser($data);

            return response()->json($userData, 201);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'User creation failed',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function loginUser(LoginUserRequest $request)
    {
        try {
            $data = $request->all();
            $userData = $this->userService->loginUser($data);

            return response()->json($userData);
        } catch (Throwable $e) {
            return response()->json([
                'message' => 'User login failed',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function logout()
    {
        try {
            $this->userService->logout();

            return response()->json(['message' => 'Successfully logged out']);
        } catch (DomainException $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function refresh()
    {
        try {
            $result = $this->userService->refreshToken();

            return response()->json($result);
        } catch (DomainException $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function me(): JsonResponse
    {
        $user = $this->userService->getCurrentUser();

        if ($user === null){
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        return response()->json($user);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;


    public function __construct(UserService $userService){
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request): \Illuminate\Http\JsonResponse
    {
        $user = $this->userService->register($request->validated());

        return response()->json([
            'message' => 'User registered successfully.',
            'data' => $user
        ], 201);

    }

    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $token = $this->userService->login($request->validated());

        return response()->json([
            'token' => $token
        ], 200);
    }
}

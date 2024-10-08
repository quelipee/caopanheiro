<?php

namespace App\User\controllers;

use App\Http\Controllers\Controller;
use App\User\dto\signIn;
use App\User\dto\signUp;
use App\User\requests\RegisterUserRequest;
use App\User\requests\SignInUserRequest;
use App\User\UserServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    public function __construct(
        protected UserServiceContract  $userService
    ){}

    public function store(RegisterUserRequest $request): JsonResponse
    {
        $user = $this->userService->initiateUserRegistration(signUp::FromValidatedRequest($request));
        return response()->json([
            'message' => 'Registration successful',
            'user' => $user
        ], ResponseAlias::HTTP_CREATED);
    }
    public function login(SignInUserRequest $request): JsonResponse
    {
        $user = $this->userService->verifyCredentials(signIn::FromValidatedRequest($request));

        return response()->json([
            'message' => 'Login successful',
            'user' => $user
        ], ResponseAlias::HTTP_OK);
    }
}
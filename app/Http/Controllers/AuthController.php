<?php

namespace App\Http\Controllers;

use App\Classes\ApiResponseClass;
use App\Http\Requests\AuthCheckRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Interfaces\AuthRepositoryInterface;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    private AuthRepositoryInterface $authRepositoryInterface;

    public function __construct(AuthRepositoryInterface $authRepositoryInterface)
    {
        $this->authRepositoryInterface = $authRepositoryInterface;
    }

    public function login(AuthLoginRequest $request): JsonResponse
    {
        try {
            $token = $this->authRepositoryInterface->login($request);
            return ApiResponseClass::sendResponse($token, 'Login successful');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function register(AuthRegisterRequest $request): void
    {

    }

    public function check(AuthCheckRequest $request): JsonResponse
    {
        try {
            $response = $this->authRepositoryInterface->check($request);
            return ApiResponseClass::sendResponse($response, 'User authenticated');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }

    public function logout(): JsonResponse
    {
        try {
            $this->authRepositoryInterface->logout();
            return ApiResponseClass::sendResponse([], 'Logged out successfully');
        } catch (\Exception $e) {
            return ApiResponseClass::throw($e, $e->getMessage());
        }
    }
}

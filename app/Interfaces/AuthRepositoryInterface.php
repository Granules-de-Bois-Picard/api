<?php

namespace App\Interfaces;

use App\Http\Requests\AuthCheckRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;

interface AuthRepositoryInterface
{
    public function login(AuthLoginRequest $request);
    public function register(AuthRegisterRequest $request);
    public function check(AuthCheckRequest $request);
    public function logout();
}

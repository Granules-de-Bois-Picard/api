<?php

namespace App\Repositories;

use App\Http\Requests\AuthCheckRequest;
use App\Http\Requests\AuthRegisterRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Http\Requests\AuthLoginRequest;
use App\Transformers\UserTransformer;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class AuthRepository implements AuthRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {

    }

    /**
     * @throws Exception
     */
    public function login(AuthLoginRequest $request): array
    {
        $credentials = $request->only('email', 'password');
        $utmSource = $request->utm_source;

        if (!Auth::attempt($credentials)) {
            throw new UnauthorizedException('Unauthorized');
        }

        $user = Auth::user();
        $this->validateUtmSourceRole($user, $utmSource);
        $token = $this->createTokenBySource($user, $utmSource);

        return [
            'data' => [
                'token' => $token,
                'user' => fractal($user, new UserTransformer())->toArray()['data'],
            ],
        ];
    }

    public function register(AuthRegisterRequest $request)
    {
        // TODO: Implement register() method.
    }

    public function check(AuthCheckRequest $request): array
    {
        $user = Auth::user();

        $this->validateUtmSourceRole($user, $request->utm_source);

        return [
            'data' => [
                'user' => fractal($user, new UserTransformer())->toArray()['data'],
            ],
        ];
    }

    public function logout(): void
    {
        Auth::user()->tokens()->delete();
    }

    private function validateUtmSourceRole($user, $utmSource): void {
        $roleMap = [
            'backoffice' => 'admin',
            'website' => 'user'
        ];

        if (!isset($roleMap[$utmSource]) || !$user->hasRole($roleMap[$utmSource])) {
            throw new UnauthorizedException('Unauthorized');
        }
    }

    private function createTokenBySource($user, $utmSource): string {
        return $user->createToken("{$utmSource}-token")->plainTextToken;
    }
}

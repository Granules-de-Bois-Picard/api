<?php

namespace App\Repositories;

use App\Http\Requests\UserChangePasswordRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Transformers\UserTransformer;
use Exception;
use Spatie\QueryBuilder\QueryBuilder;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function index(): ?array
    {
        $users = QueryBuilder::for(User::class)
            ->orderBy('created_at', 'desc')
            ->paginate(11);

        return fractal($users, new UserTransformer())->toArray();
    }

    public function store(UserStoreRequest $request)
    {

    }

    public function show($id): ?array
    {
        $user = User::findOrFail($id);

        return fractal($user, new UserTransformer())->toArray();
    }

    /**
     * @throws Exception
     */
    public function update(UserUpdateRequest $request, $id): ?array
    {
        $user = User::findOrFail($id);

        $user->update($request->validated());

        return fractal($user, new UserTransformer())->toArray();
    }

    /**
     * @throws Exception
     */
    public function changePassword(UserChangePasswordRequest $request, $id): ?array
    {
        $user = User::findOrFail($id);

        if (!password_verify($request->validated()['current_password'], $user->password)) {
            throw new Exception('Current password is incorrect.');
        }

        $user->update([
            'password' => bcrypt($request->validated()['password']),
        ]);

        return fractal($user, new UserTransformer())->toArray();
    }

    public function destroy($id)
    {

    }
}

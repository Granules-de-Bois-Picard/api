<?php

namespace App\Repositories;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Transformers\UserTransformer;
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

    public function update(UserUpdateRequest $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}

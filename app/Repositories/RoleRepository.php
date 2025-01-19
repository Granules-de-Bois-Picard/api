<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Transformers\RoleTransformer;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\QueryBuilder;

class RoleRepository implements RoleRepositoryInterface
{
    private string $guard_name;

    public function __construct()
    {
        $this->guard_name = config('auth.defaults.guard');
    }

    public function index(): ?array
    {
        $users = QueryBuilder::for(Role::class)
            ->orderBy('created_at', 'desc')
            ->paginate(11);

        return fractal($users, new RoleTransformer())->toArray();
    }

    public function store($request): ?array
    {
        $role = Role::create($request->validated());

        $role->guard_name = $this->guard_name;
        $role->save();

        return fractal($role, new RoleTransformer())->toArray();
    }

    public function show($id): ?array
    {
        $role = Role::findOrFail($id);

        return fractal($role, new RoleTransformer())->toArray();
    }

    public function update($request, $id): ?array
    {
        $role = Role::findOrFail($id);
        $permissions = $request->permissions;

        $role->syncPermissions($permissions);
        $role->update($request->validated());

        return fractal($role, new RoleTransformer())->toArray();
    }

    public function destroy($id): ?bool
    {
        $role = Role::findOrFail($id);

        $role->syncPermissions([]);

        return $role->delete();
    }
}

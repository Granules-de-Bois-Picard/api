<?php

namespace App\Repositories;

use App\Interfaces\RoleRepositoryInterface;
use App\Transformers\RoleTransformer;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\QueryBuilder;

class RoleRepository implements RoleRepositoryInterface
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
        $users = QueryBuilder::for(Role::class)
            ->orderBy('created_at', 'desc')
            ->paginate(11);

        return fractal($users, new RoleTransformer())->toArray();
    }

    public function store($request): ?array
    {
        if (!isset($request->guard_name)) {
            $request->guard_name = 'web';
        }

        $role = Role::create($request->validated());

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

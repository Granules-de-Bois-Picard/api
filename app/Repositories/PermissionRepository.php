<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use App\Transformers\PermissionTransformer;
use Spatie\Permission\Models\Permission;
use Spatie\QueryBuilder\QueryBuilder;

class PermissionRepository implements PermissionRepositoryInterface
{
    private string $guard_name;

    public function __construct()
    {
        $this->guard_name = 'web';
    }

    public function all(): ?array
    {
        $permissions = QueryBuilder::for(Permission::class)
            ->orderBy('created_at', 'desc')
            ->get();

        return fractal($permissions, new PermissionTransformer())->toArray();
    }

    public function index(): ?array
    {

        $permissions = QueryBuilder::for(Permission::class)
            ->orderBy('created_at', 'desc')
            ->paginate(14);

        return fractal($permissions, new PermissionTransformer())->toArray();
    }

    public function store($request): ?array
    {
        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => $this->guard_name,
        ]);

        return fractal($permission, new PermissionTransformer())->toArray();
    }

    public function show($id): ?array
    {
        $permission = Permission::findOrFail($id);

        return fractal($permission, new PermissionTransformer())->toArray();
    }
}

<?php

namespace App\Transformers;

use App\Traits\PermissionFilterTrait;
use League\Fractal\TransformerAbstract;
use Spatie\Permission\Models\Role;

class RoleTransformer extends TransformerAbstract
{
    use PermissionFilterTrait;

    public function transform(Role $role): array
    {
        $data = [
            'id' => $role->id,
            'name' => $role->name,
            'permissions' => $role->permissions->pluck('name'),
            'created_at' => $role->created_at->toDateTimeString(),
            'updated_at' => $role->updated_at->toDateTimeString(),
        ];

        //return $this->filterByModelPermissions($data, 'user');
        return $data;
    }
}

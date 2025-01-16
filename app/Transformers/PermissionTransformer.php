<?php

namespace App\Transformers;

use App\Traits\PermissionFilterTrait;
use League\Fractal\TransformerAbstract;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTransformer extends TransformerAbstract
{
    use PermissionFilterTrait;

    public function transform(Permission $permission): array
    {
        $data = [
            'id' => $permission->id,
            'name' => $permission->name,
            'created_at' => $permission->created_at->toDateTimeString(),
            'updated_at' => $permission->updated_at->toDateTimeString(),
        ];

        //return $this->filterByModelPermissions($data, 'user');
        return $data;
    }
}

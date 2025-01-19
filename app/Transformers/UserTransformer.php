<?php

namespace App\Transformers;

use App\Models\User;
use App\Traits\PermissionFilterTrait;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    use PermissionFilterTrait;

    public function transform(User $user): array
    {
        $data = [
            'id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'profile_picture' => $user->profile_picture ? asset($user->profile_picture) : null,
            'email' => $user->email,
            'locale' => $user->locale,
            'roles' => $user->roles->pluck('name'),
            "permissions" => $user->getAllPermissions()->pluck('name'),
            'created_at' => $user->created_at->toDateTimeString(),
            'updated_at' => $user->updated_at->toDateTimeString(),
        ];

        return $this->filterByModelPermissions($data, 'user');
    }
}

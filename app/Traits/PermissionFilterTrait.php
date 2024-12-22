<?php
namespace App\Traits;

trait PermissionFilterTrait
{
    protected function filterByModelPermissions(array $data, string $modelType): array
    {
        $user = auth()->user();
        $permissions = $user->getAllPermissions()->pluck('name');
        $filteredData = [];

        if ($permissions->contains($modelType . '.view.*')) {
            return $data;
        }

        foreach ($permissions as $permission) {
            $permissionParts = explode('.', $permission);

            if (count($permissionParts) === 3 &&
                $modelType === $permissionParts[0] &&
                $permissionParts[1] === 'view' &&
                isset($data[$permissionParts[2]])) {

                $filteredData[$permissionParts[2]] = $data[$permissionParts[2]];
            }
        }

        return $filteredData;
    }
}

<?php

namespace App\Transformers;

use App\Models\File;
use App\Traits\PermissionFilterTrait;
use League\Fractal\TransformerAbstract;

class FileTransformer extends TransformerAbstract
{
    use PermissionFilterTrait;

    public function transform(File $file): array
    {
        $data = [
            'id' => $file->id,
            'name' => $file->name,
            'url' => asset($file->path),
            'size' => $file->size,
            'extension' => $file->extension,
            'is_protected' => $file->is_protected,
            'created_at' => $file->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $file->updated_at->format('Y-m-d H:i:s'),
        ];

        return $this->filterByModelPermissions($data, 'file');
    }
}

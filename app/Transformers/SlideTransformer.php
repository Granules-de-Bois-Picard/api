<?php

namespace App\Transformers;

use App\Models\Slide;
use App\Traits\PermissionFilterTrait;
use League\Fractal\TransformerAbstract;

class SlideTransformer extends TransformerAbstract
{
    use PermissionFilterTrait;

    public function transform(Slide $slide): array
    {
        $data = [
            'id' => $slide->id,
            'title' => $slide->title,
            'text' => $slide->text,
            'image_url' => $slide->image_url,
            'redirect_url' => $slide->redirect_url,
            'order' => $slide->order,
            'created_at' => $slide->created_at->toDateTimeString(),
            'updated_at' => $slide->updated_at->toDateTimeString(),
        ];

        //return $this->filterByModelPermissions($data, 'user');
        return $data;
    }
}

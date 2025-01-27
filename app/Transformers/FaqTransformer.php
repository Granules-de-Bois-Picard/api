<?php

namespace App\Transformers;

use App\Models\Article;
use App\Models\Faq;
use App\Traits\PermissionFilterTrait;
use League\Fractal\TransformerAbstract;

class FaqTransformer extends TransformerAbstract
{
    use PermissionFilterTrait;

    public function transform(Faq $item)
    {
        $data = [
            'id' => $item->id,
            'question' => $item->question,
            'answer' => $item->answer,
            'created_at' => $item->created_at->toDateTimeString(),
            'updated_at' => $item->updated_at->toDateTimeString(),
        ];

        //return $this->filterByModelPermissions($data, 'user');
        return $data;
    }
}

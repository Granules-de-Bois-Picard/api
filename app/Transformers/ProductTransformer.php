<?php

namespace App\Transformers;

use App\Models\Product;
use App\Traits\PermissionFilterTrait;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    use PermissionFilterTrait;

    public function transform(Product $product)
    {
        $data = [
            'id' => $product->id,
            'name' => $product->name,
            'brand' => $product->brand,
            'type' => $product->type,
            'model' => $product->model,
            'dimensions' => $product->dimensions,
            'weight' => $product->weight,
            'certifications' => $product->certifications,
            'created_at' => $product->created_at->toDateTimeString(),
            'updated_at' => $product->updated_at->toDateTimeString(),
        ];

        //return $this->filterByModelPermissions($data, 'user');
        return $data;
    }
}

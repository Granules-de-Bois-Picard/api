<?php

namespace App\Transformers;

use App\Models\Article;
use App\Traits\PermissionFilterTrait;
use League\Fractal\TransformerAbstract;

class ArticleTransformer extends TransformerAbstract
{
    use PermissionFilterTrait;

    public function transform(Article $article): array
    {
        $data = [
            'id' => $article->id,
            'title' => $article->title,
            'slug' => $article->slug,
            'short_description' => $article->short_description,
            'thumbnail' => $article->thumbnail,
            'content' => $article->content,
            'is_published' => $article->is_published,
            'created_at' => $article->created_at->toDateTimeString(),
            'updated_at' => $article->updated_at->toDateTimeString(),
        ];

        //return $this->filterByModelPermissions($data, 'user');
        return $data;
    }
}

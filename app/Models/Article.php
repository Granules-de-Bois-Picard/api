<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $id
 * @property mixed $title
 * @property mixed $slug
 * @property mixed $short_description
 * @property mixed $thumbnail
 * @property mixed $content
 * @property mixed $is_published
 * @property mixed $created_at
 * @property mixed $updated_at
 * @method static create(mixed $validated)
 * @method static where(string $string, string $slug)
 * @method static findOrFail($id)
 * @method static firstOrFail()
 */
class Article extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'thumbnail',
        'content',
        'is_published',
    ];
}

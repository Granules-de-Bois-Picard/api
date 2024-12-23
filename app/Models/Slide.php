<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $id
 * @property mixed $title
 * @property mixed $text
 * @property mixed $image_url
 * @property mixed $redirect_url
 * @property mixed $order
 * @property mixed $created_at
 * @property mixed $updated_at
 * @method static create(mixed $validated)
 * @method static findOrFail($id)
 */
class Slide extends Model
{
    use HasUuids;

    protected $fillable = [
        'title',
        'text',
        'image_url',
        'redirect_url',
        'order',
    ];
}

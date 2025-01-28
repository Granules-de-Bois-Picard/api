<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $type
 * @property mixed $brand
 * @property mixed $model
 * @property mixed $dimensions
 * @property mixed $weight
 * @property mixed $certifications
 * @property mixed $created_at
 * @property mixed $updated_at
 * @method static findOrFail($id)
 * @method static create(mixed $validated)
 */
class Product extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'thumbnail_url',
        'type',
        'brand',
        'model',
        'dimensions',
        'weight',
        'certifications',
    ];
}

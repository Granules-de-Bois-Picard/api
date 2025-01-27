<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $id
 * @property mixed $name
 * @property mixed $path
 * @property mixed $extension
 * @property mixed $size
 * @property mixed $is_public
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $is_protected
 * @method static create(array $array)
 * @method static findOrFail($id)
 * @method static where(string $string, array|false|int|string|null $path)
 */
class File extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'path',
        'extension',
        'size',
        'is_protected',
    ];
}

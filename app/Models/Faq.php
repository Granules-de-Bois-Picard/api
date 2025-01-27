<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $question
 * @property mixed $answer
 * @property mixed $id
 * @property mixed $created_at
 * @property mixed $updated_at
 * @method static findOrFail($id)
 * @method static create(mixed $validated)
 */
class Faq extends Model
{
    use HasUuids;

    protected $fillable = [
        'question',
        'answer',
    ];
}

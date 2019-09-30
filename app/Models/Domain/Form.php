<?php

namespace App\Models\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static create(array $array)
 */
class Form extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'formElements' => 'array'
    ];

    public function contract()
    {
        return $this->belongsTo('App\Models\Domain\Contract');
    }
}

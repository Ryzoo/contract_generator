<?php

namespace App\Models\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'attributesOrder' => 'array'
    ];

    public function contract()
    {
        return $this->belongsTo('App\Models\Domain\Contract');
    }
}

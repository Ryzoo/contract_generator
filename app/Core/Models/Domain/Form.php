<?php

namespace App\Core\Models\Domain;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'formElements' => 'array'
    ];

    public function contract()
    {
        return $this->belongsTo('App\Core\Models\Domain\Contract');
    }
}

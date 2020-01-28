<?php

namespace App\Core\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Core\Models\Database\Contract;

class Form extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $casts = [
        'formElements' => 'array'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}

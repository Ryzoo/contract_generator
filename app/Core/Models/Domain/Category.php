<?php

namespace App\Core\Models\Domain;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $guarded = [];

    public function contracts()
    {
        return $this->belongsToMany('App\Core\Models\Domain\Contract');
    }
}

<?php

namespace App\Core\Models\Database;

use Illuminate\Database\Eloquent\Model;
use App\Core\Models\Database\Contract;

class Category extends Model
{
    protected $guarded = [];

    public function contracts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
        return $this->belongsToMany(Contract::class);
    }
}

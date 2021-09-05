<?php

namespace App\Core\Models\Database;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function contracts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany {
        return $this->belongsToMany(Contract::class);
    }
}

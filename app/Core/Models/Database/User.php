<?php

namespace App\Core\Models\Database;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use App\Core\Models\Database\ContractFormComplete;

class User extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;
    use HasRoleAndPermission;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'resetPasswordToken',
    ];

    protected $dates = [
        'deleted_at',
    ];

    public function completedForm(): \Illuminate\Database\Eloquent\Relations\HasMany {
        return $this->hasMany(ContractFormComplete::class);
    }
}

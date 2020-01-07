<?php

namespace App\Core\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;

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

    public function completedForm()
    {
        return $this->hasMany('App\Core\Models\Domain\ContractFormComplete');
    }
}

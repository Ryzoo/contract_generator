<?php

namespace App\Core\Models\Database;

use App\Core\Models\Domain\FormElements\FormElement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use App\Core\Models\Database\User;
use App\Core\Models\Database\Contract;

class ContractFormComplete extends Model
{
    use SoftDeletes;

    protected $guarded = [];
    protected $casts = [
        'form_elements' => 'array',
    ];
    protected $dates = [
        'deleted_at',
    ];

    public function getFormElementsAttribute($value): Collection
    {
      $currentValue = $value ?? $this->settings ?? NULL;
      return $currentValue ? collect(FormElement::getListFromString($currentValue)) : collect();
    }

    public function setFormElementsAttribute($value): void {
        $this->attributes['form_elements'] = json_encode($value, JSON_THROW_ON_ERROR, 512);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function contract(): \Illuminate\Database\Eloquent\Relations\BelongsTo {
        return $this->belongsTo(Contract::class);
    }
}

<?php

namespace App\Core\Models\Domain;

use App\Core\Models\Domain\FormElements\FormElement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

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
        return FormElement::getListFromString($value ?? $this->form_elements);
    }

    public function setFormElementsAttribute($value)
    {
        $this->attributes['form_elements'] = json_encode($value);
    }

    public function user()
    {
        return $this->belongsTo('App\Core\Models\User');
    }

    public function contract()
    {
        return $this->belongsTo('App\Core\Models\Domain\Contract');
    }
}

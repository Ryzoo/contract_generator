<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractInfo extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "categories" => $this->categories ?? [],
            "created_at" => (new Carbon($this->created_at))->diffForHumans(),
        ];
    }
}

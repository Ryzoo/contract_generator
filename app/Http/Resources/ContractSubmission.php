<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractSubmission extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->contract->name,
            "render_url" => $this->render_url,
            "status" => (int)$this->status,
            "action_details" => json_decode($this->action_details, true),
            "updated_at" => (new Carbon($this->updated_at))->diffForHumans()
        ];
    }
}

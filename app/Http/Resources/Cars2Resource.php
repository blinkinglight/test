<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Cars2Resource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'number' => $this->number,
            'year_made' => $this->year_made,
            'model' => $this->model,
            'status' => $this->carStatus?->get(0)?->status?->name,
            'user' => $this->CurrentName,
            'prev_user' => $this->PrevName,

        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarsResource extends JsonResource
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
            'number' => $this->car->number,
            'year_made' => $this->car->year_made,
            'model' => $this->car->model,
            'status' => $this->car->status?->status?->name,
            'user' => $this->UserName,
            'prev_user' => $this->car->prevManagement?->UserName,
        ];
    }
}

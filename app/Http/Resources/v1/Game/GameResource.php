<?php

namespace App\Http\Resources\v1\Game;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\v1\Army\ArmyCollection;

class GameResource extends JsonResource
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
            'id' => $this->id,
            'status' => $this->status,
            'armies' => new ArmyCollection($this->whenLoaded('armies')),
            'remaining_armies' => new ArmyCollection($this->whenLoaded('remaining_armies')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

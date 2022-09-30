<?php

namespace App\Http\Resources\v1\Army;

use Illuminate\Http\Resources\Json\JsonResource;

class ArmyResource extends JsonResource
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
            'game_id' => $this->game_id,
            'name' => $this->name,
            'initial_units' => $this->initial_units,
            'units' => $this->units,
            'attack_strategy' => $this->attack_strategy,
            'ordinal' => $this->ordinal,
            'damage' => $this->damage,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

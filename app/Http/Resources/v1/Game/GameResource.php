<?php

namespace App\Http\Resources\v1\Game;

use App\Http\Resources\v1\Army\ArmyResource;
use App\Http\Resources\v1\Army\ArmyCollection;
use Illuminate\Http\Resources\Json\JsonResource;

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
            'round_count' => $this->round_count,
            'army_winner' => new ArmyResource($this->whenLoaded('winner')),
            'armies_count' => $this->armies_count,
            'remaining_armies_count' => $this->remaining_armies_count,
            'armies' => new ArmyCollection($this->whenLoaded('armies')),
            'remaining_armies' => new ArmyCollection($this->whenLoaded('remaining_armies')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}

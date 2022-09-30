<?php

namespace App\Http\Resources\v1\Game;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GameCollection extends ResourceCollection
{
    public $collects = GameResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}

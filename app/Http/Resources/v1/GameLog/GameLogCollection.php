<?php

namespace App\Http\Resources\v1\GameLog;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GameLogCollection extends ResourceCollection
{
    public $collects = GameLogResource::class;

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

<?php

namespace App\Http\Resources\v1\Army;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArmyCollection extends ResourceCollection
{
    public $collects = ArmyResource::class;

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

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeparTement extends JsonResource
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
            'ID_departement'     => $this->ID_departement,
            'Parent'             => $this->Parent,
            'name'               => $this->name,
            'order'              => $this->order,
            'departement_head'   => $this->departement_head,
            'active'             => $this->active,
        ];
    }
}
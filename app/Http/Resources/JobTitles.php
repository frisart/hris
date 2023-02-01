<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobTitles extends JsonResource
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
            'id_job_title'     => $this->id_job_title,
            'departement'      => $this->departement,
            'name'             => $this->name,
            'order'            => $this->order,
            'active'           => $this->active,
        ];
    }
}
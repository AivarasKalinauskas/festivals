<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Festival extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
//        return parent::toArray($request);

        return [
            'id' => $this->id,
            'title' => $this->title,
            'address' => $this->address,
            'place_name' => $this->place_name,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'description' => $this->description,
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
            'cover' => $this->cover,
            'video' => $this->video,
            'link' => $this->link,
            'facebook' => $this->facebook
        ];
    }
}

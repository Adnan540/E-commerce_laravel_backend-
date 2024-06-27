<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class shipResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'user_id'=>$this->user_id,
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'address_line_1'=>$this->address_line_1,
            'address_line_2'=>$this->address_line_2,
            'city'=>$this->city,
            'state'=>$this->state,
            'zip_code'=>$this->zip_code,
            'country'=>$this->country
        ];
    }
}

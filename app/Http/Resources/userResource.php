<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class userResource extends JsonResource
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
            'name'=>$this->name,
            'email'=>$this->email,
            'password'=>$this->password,
            'Orders'=>[
                "user orders"=>$this->orders
            ],
            'Adresses'=>[
                "user address"=>$this->shippingAddresses
            ],
            'Reviews'=>[
                "user reviews"=>$this->reviews
            ],
            'Wishlist'=>[
                "user wishlists"=>$this->wishlist
            ],
            




            
        ];
    }
}

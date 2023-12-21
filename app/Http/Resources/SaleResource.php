<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SaleResource extends JsonResource
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
            "id"=> $this->id,
            "name"=> $this->name,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email"=> $this->email ??'',
            "address"=> $this->address ??'',
            "district_id"=> $this->district_id ??'',
            'type' => $this->type,
            "image"=> $this->image ? url($this->image): '',
            "api_token"=> $this->api_token ?? ''
        ];
    }
}

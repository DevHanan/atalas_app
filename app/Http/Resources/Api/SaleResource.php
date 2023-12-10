<?php

namespace App\Http\Resources\Api;

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
            "phone" => $this->phone,
            "email"=> $this->email ??'',
            "district"=> optional($this->district)->title ??'',
            "province"=> optional($this->province)->title ??'',
            "api_token"=> $this->api_token ?? ''
        ];
    }
}

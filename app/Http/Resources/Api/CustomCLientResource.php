<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CustomCLientResource extends JsonResource
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
            "id"=> $this['client']->id,
            "first_name"=> $this['client']->first_name,
            "last_name"=> $this['client']->last_name,
            "phone" => $this['client']->phone,
            "email"=> $this['client']->email ??'',
            "district"=> optional($this['client']->district)->title ??'',
            "province"=> optional($this['client']->province)->title ??'',
            "api_token"=> $this['client']->api_token ?? '',
            "lat"=> $this['client']->lat,
            "lng"=> $this['client']->lng,
            'order_number' => $this->order_number,
            'order_total'  => $this->order_total,
            'paid'=> $this->paid,
            'remaining' => $this->remaining
        ];
    }
}

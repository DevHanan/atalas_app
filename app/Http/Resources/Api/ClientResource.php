<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            "first_name"=> $this->first_name,
            "last_name"=> $this->last_name,
            "phone" => $this->phone,
            "email"=> $this->email ??'',
            "district"=> optional($this->district)->title ??'',
            "province"=> optional($this->province)->title ??'',
            'api_token' => $this->when(auth()->guard('clients')->check(), $this->api_token),
            "lat"=> $this->lat,
            "lng"=> $this->lng,
            'activity_name' => $this->activity_name,
            'join_date' => $this->created_at->format('m/d/Y')
        ];
    }
}

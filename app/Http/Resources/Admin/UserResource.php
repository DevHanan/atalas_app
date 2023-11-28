<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\CityResource;
use App\Http\Resources\InterestResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            "mobile"=> $this->mobile,
            "email"=> $this->email ??'',
            "image"=> $this->image ? url($this->image): '',
            "city"=>new CityResource($this->city) ??'',
            "gender"=>$this->gender ?? '',
            "birthdate"=>$this->birthdate ?? '',
            "api_token"=> $this->api_token ?? '',
            "notification_status"=> $this->notification_status ?? 0,
            "interests" => InterestResource::collection($this->interests),
            "is_active" =>$this->is_active
        ];
    }
}

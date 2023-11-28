<?php

namespace App\Http\Resources;

use App\Http\Resources\CityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ProviderResource extends JsonResource
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
            "image"=> $this->image ? url($this->image): '',
            "name"=> $this->name,
            "email"=> $this->email ??'',
            "tel1"=> $this->tel1 ?? '',
            "tel2" => $this->tel2 ?? '',
            "description" => $this->description,
            "facebook_url" => $this->facebook_url ?? '#',
            "twitter_url" =>$this->twitter_url ?? '#',
            "instagram_url" =>$this->instagram_url ?? '#',
            "youtube_url" =>$this->youtube_url ?? '#',
            "snapchat_url" =>$this->snapchat_url ?? '#',
            "address"=>$this->address,
            "city" =>$this->city ? new CityResource($this->city) : '',
            "is_active" =>(bool) $this->is_active,
            'avgrate'  => $this->avgRate
        ];
    }
}

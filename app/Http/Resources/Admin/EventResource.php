<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\Admin\ProviderResource;
use App\Http\Resources\CityResource;
use App\Http\Resources\InterestResource;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'id'=>$this->id,
            'images'=>EventImageResource::collection($this->images),
            'name'=>$this->getTranslations('name'),
            'from'=>$this->from,
            'to'=>$this->to,
            'price'=>$this->price,
            'interest'=>new InterestResource($this->interest),
            'city'=>new CityResource($this->city) ?? '',
            'provider'=>new ProviderResource($this->provider) ?? '',
            'address'=>$this->getTranslations('address'),
            'about'=>$this->getTranslations('about'),
            'status'=>$this->status,
            'cancel_reason'=>$this->cancel_reason ??'',
            'total_attend_count'=>$this->total_attend_count,
            'lat'=>$this->lat,
            'lng'=>$this->lng,
            'users_images'=>UserEventImageResource::collection($this->users->take(5))
        ];
    }
}

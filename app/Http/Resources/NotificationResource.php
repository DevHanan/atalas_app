<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            "title"=> $this->title,
            "body"=> $this->body,
            "type" => $this->type,
            "item_id" => $this->item_id,
            "img" => asset($this->img),
            "created_at"=> $this->created_at ?? date('Y-m-d H:i:s'),
        ];
    }
}

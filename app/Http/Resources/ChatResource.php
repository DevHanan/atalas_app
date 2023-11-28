<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
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
            "type"=> $this->type,
            "message"=> $this->message,
            "file"=> $this->file ? url($this->file) : '',
            "sender_id"=> $this->sender_id ??'',
            "created_at" =>date('Y-m-d H:i:s',strtotime($this->created_at))
        ];
    }
}

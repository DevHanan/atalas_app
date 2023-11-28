<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            "question"=> $this->question,
            "is_required"=> $this->is_required,
            "placeholder"=> $this->placeholder ?? '',
            "type"=> $this->type ?? 'text',
            "selects"=> QuestionSelectResource::collection($this->selects)
        ];
    }
}

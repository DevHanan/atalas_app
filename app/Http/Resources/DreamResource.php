<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DreamResource extends JsonResource
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
            "user_id"=> $this->user_id,
            "interpreter_id"=> $this->interpreter_id,
            "user"=> new UserResource($this->user),
            "interpreter"=> new InterpreterResource($this->interpreter),
            "answers"=> AnswerResource::collection($this->answers),
            "interpreter_answer"=> $this->interpreter_answer ?? '',
            "interpreter_answer2"=> $this->interpreter_answer2 ?? '',
            "created_at"=> $this->created_at,
            "status" =>$this->status
        ];
    }
}

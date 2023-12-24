<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use  App\Http\Resources\Api\ClientResource;
class VisitResource extends JsonResource
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
            "visit_date"=> $this->visit_date,
            "report"=> $this->report,
            "code" => $this->code,
            "client"=> new ClientResource($this->client)
        ];
    }
}
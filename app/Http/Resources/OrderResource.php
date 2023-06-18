<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'code'=>$this->code,
            'name'=>$this->name,
            'phone'=>$this->phone,
            'note'=>$this->note,
            'guest'=>$this->guest,
            'status'=>$this->status,
            'table_type'=>$this->table_type,
            'place_type'=>$this->place_type,
        ];
    }
}

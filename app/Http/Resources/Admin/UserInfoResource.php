<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class UserInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data= [
            'id'=>$this->id,
            'name'=>$this->name,
            'phone'=>$this->phone,
            'date_of_birth'=>$this->date_of_birth,
            'image'=>url($this->getRawOriginal('image')),


        ];

        return $data;
    }
}

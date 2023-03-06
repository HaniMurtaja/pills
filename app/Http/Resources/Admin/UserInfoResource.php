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
            'full_name'=>$this->name,
            'phone'=>$this->phone,
            'dob'=>$this->dob,
            'image'=> $this->image,


        ];

        return $data;
    }
}

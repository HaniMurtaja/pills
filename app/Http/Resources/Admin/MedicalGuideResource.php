<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class MedicalGuideResource extends JsonResource
{
    public function toArray($request)
    {


        $data = [

            'id'=>$this->id,
            'guide_name'=>$this->guide_name,
            'guide_category'=>$this->guide_category,
            'guide_phone'=>$this->guide_phone,
            'guide_working_hours'=>$this->guide_working_hours,
            'guide_status'=>$this->guide_status,
            'latitude'=>$this->latitude,
            'longitude'=>$this->longitude,
            'created_at'=>$this->created_at,
            'guide_image'=>$this->guide_image,
            'media'=>$this->media,
        ];


        return $data ;

    }
}

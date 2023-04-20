<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class ReminderResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [

            'doses'=>$this->doses,
            'times'=>$this->times,
            'applying'=>$this->applying,
            'time'=>$this->time,
            'duration'=>$this->duration,
            'days_of_week'=>$this->days_of_week,
            'start_from'=>$this->start_from,
            'snooze'=>$this->snooze,
            'date'=>$this->date,
           
        ];


        return $data ;
    }
}

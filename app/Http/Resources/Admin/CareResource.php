<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Resources\Json\JsonResource;

class CareResource extends JsonResource
{
    public function toArray($request)
    {
        $data= [
            
            'id'=>$this->carebiesUsers->id,
            'name'=>$this->carebiesUsers->name,
            'relation'=>$this->carebiesUsers->relation,
            'image'=>url($this->carebiesUsers->getRawOriginal('image')),
            'last_update'=>$this->updated_at->diffForHumans(),
            'reminder_count'=>$this->carebiesUsers->userReminderReminders->count()


        ];

        return $data;
    }
}

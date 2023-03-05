<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBasicInfo extends Model
{
    use HasFactory;

    protected $fillable = ['full_name','image','date_of_birth','phone','country_code'];


    public function getImageAttribute($key)
    {
        if ($key == '' || is_null($key))
            return asset('Avatar.png');
        else
            return asset($key);
    }
}

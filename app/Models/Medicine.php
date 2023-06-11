<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'medicines';

    protected $dates = [
        'med_expire_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'med_generic_name',
        'med_scientific_name',
        'med_quantity',
        'med_expire_date',
        'user_med_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'reminder_id',
    ];

    public function getMedExpireDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setMedExpireDateAttribute($value)
    {
        $this->attributes['med_expire_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function user_med()
    {
        return $this->belongsTo(User::class, 'user_med_id');
    }

    public function care_med()
    {
        return $this->belongsTo(User::class, 'care_medicine_id');
    }

    public function care_meds()
    {
        return $this->belongsToMany(UserHealth::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function reminder(){

        return $this->belongsTo(Reminder::class);
    }
}
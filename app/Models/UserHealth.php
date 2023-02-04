<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserHealth extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const GENDER_SELECT = [
        'Male'   => 'Male',
        'Female' => 'Female',
    ];

    public $table = 'user_healths';

    protected $dates = [
        'dob',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'careby_id',
        'name',
        'gender',
        'dob',
        'blood_pressure',
        'blood_group',
        'height',
        'weight',
        'bmi',
        'total_cholestrol',
        'ldl_cholestrol',
        'hdl_cholestrol',
        'triglycerides',
        'glucose',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function careDocsUserDocs()
    {
        return $this->belongsToMany(UserDoc::class);
    }

    public function carebiesUsers()
    {
        return $this->belongsToMany(User::class);
    }

    public function careMedMedicines()
    {
        return $this->belongsToMany(Medicine::class);
    }

    public function getDobAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDobAttribute($value)
    {
        $this->attributes['dob'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

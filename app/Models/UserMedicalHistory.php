<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMedicalHistory extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'user_medical_histories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'disease_name',
        'description',
        'user_history_id',
        'care_medical_history_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function user_history()
    {
        return $this->belongsTo(User::class, 'user_history_id');
    }

    public function care_history()
    {
        return $this->belongsTo(User::class, 'care_medical_history_id');
    }

    public function care_histories()
    {
        return $this->belongsToMany(UserHealth::class);
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

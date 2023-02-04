<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'subscriptions';

    protected $dates = [
        'subsription_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user',
        'payment_method',
        'subsription_date',
        'user_subs_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getSubsriptionDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setSubsriptionDateAttribute($value)
    {
        $this->attributes['subsription_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function user_subs()
    {
        return $this->belongsTo(User::class, 'user_subs_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}

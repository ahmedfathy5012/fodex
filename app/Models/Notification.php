<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'text','user_id', 'timestamps');
    protected $visible = array('title', 'text', 'user_id','timestamps');
    public function getCreatedAtAttribute($value)
    {
        Carbon::setLocale('ar');
           $time = Carbon::parse($value);
           return $time->diffForHumans();
    }
}
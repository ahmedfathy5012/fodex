<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Employee;
use App\User;
use Carbon\Carbon;

class UserWalletTransformation extends Model 
{

    protected $table = 'user_wallet_transformations';
    public $timestamps = true;
    protected $guarded = [];

  

    public function employee()
    {
        return $this->belongsTo(Employee::class,"employee_id");
    } public function user()
    {
        return $this->belongsTo(User::class,"user_id");
    }
public function getCreatedAtAttribute($value)
    {
        Carbon::setLocale('ar');
           $time = Carbon::parse($value);
           return $time->diffForHumans();
    }
}
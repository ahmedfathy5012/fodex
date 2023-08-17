<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DashboardNotification extends Model 
{

    protected $table = 'dashboard_notifications';
    public $timestamps = true;
    protected $guarded =[];
    //protected $visible = array('day_name');

}
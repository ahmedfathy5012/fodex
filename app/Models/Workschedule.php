<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use App\Models\Day;
class Workschedule extends Model 
{

    protected $table = 'workschedules';
    public $timestamps = true;
  //  protected $fillable = array('id','work_from', 'work_to', 'day_id', 'seller_id');
  //  protected $visible = array('id','work_from', 'work_to', 'day_id', 'seller_id');

    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id');
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class, 'seller_id');
    }

}
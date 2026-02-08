<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\BoxStatus;
class Box extends Model
{
   protected $table = 'boxs';
    public $timestamps = true;
    public function box_status(){
        return $this->belongsTo(BoxStatus::class,"boxstatus_id");
    }
}

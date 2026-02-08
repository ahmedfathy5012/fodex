<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armycase extends Model 
{

    protected $table = 'armycases';
    public $timestamps = true;
    protected $fillable = array('id','title');
    protected $visible = array('id','title');

    // public function employees()
    // {
    //     return $this->hasMany('Employee', 'armycase_id');
    // }

}
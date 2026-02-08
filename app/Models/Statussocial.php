<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Statussocial extends Model 
{

    protected $table = 'statussocials';
    public $timestamps = true;
    protected $fillable = array('id','title');
    protected $visible = array('id','title');

    // public function employees()
    // {
    //     return $this->hasMany('Employee', 'statussocial_id');
    // }

}
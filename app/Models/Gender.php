<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model 
{

    protected $table = 'gender';
    public $timestamps = true;
    protected $fillable = array('id','title');
    protected $visible = array('id','title');

    public function employees()
    {
        return $this->hasMany('Employee', 'gender_id');
    }

}
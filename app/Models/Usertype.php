<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usertype extends Model 
{

    protected $table = 'usertypes';
    public $timestamps = true;
    protected $fillable = array('title');
    protected $visible = array('title');

    public function users()
    {
        return $this->hasMany('User', 'usertype_id');
    }

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobtitle extends Model 
{

    protected $table = 'jobtitles';
    public $timestamps = true;
    protected $fillable = array('title', 'description', 'notes');
    protected $visible = array('title', 'description', 'notes');

    public function employees()
    {
        return $this->hasMany('Employee', 'jobtitle_id');
    }

}
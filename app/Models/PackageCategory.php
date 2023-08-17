<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageCategory extends Model 
{

    protected $table = 'packages_categories';
    public $timestamps = true;
    protected $fillable = array('id','title');
    protected $visible = array('id','title');

   

}
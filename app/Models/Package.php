<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CountryPackage;
class Package extends Model
{
       public $guarded = [];
       public function prices(){
              return $this->hasMany(CountryPackage::class,'package_id');
       }
}

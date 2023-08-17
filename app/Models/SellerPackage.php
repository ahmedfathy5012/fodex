<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Package;
class SellerPackage extends Model
{
    protected $table = 'sellers_packages';
    public $timestamps = true;
    public function package(){
        return $this->belongsTo(Package::class,'package_id');
    }
}

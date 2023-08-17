<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use Carbon\Carbon;
class AllcollectionType extends Model 
{

    protected $table = 'allcollections_types';
    public $timestamps = true;
   protected $guarded = [];

}
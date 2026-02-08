<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use Carbon\Carbon;
use App\Models\AllcollectionType;
class Income extends Model 
{

    protected $table = 'incomes';
    public $timestamps = true;
 //  protected $guarded = [];
  public function type(){
      return $this->belongsTo(AllcollectionType::class,'collectiontype_id');
  }
}
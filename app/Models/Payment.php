<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
class Payment extends Model
{
   
    protected $table = 'payments';
    public $timestamps = true;
    protected $fillable = array('id','title');
    protected $visible = array('id','title');
}

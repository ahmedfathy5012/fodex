<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Extra;
class Extradetail extends Model 
{

    protected $table = 'extradetails';
    public $timestamps = true;
    protected $fillable = array('id','title', 'extra_price', 'extra_id');
    protected $visible = array('id','title', 'extra_price', 'extra_id');

    public function extra()
    {
        return $this->belongsTo(Extra::class, 'extra_id');
    }

}
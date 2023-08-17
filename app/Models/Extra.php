<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use App\Models\Extradetail;
class Extra extends Model 
{

    protected $table = 'extras';
    public $timestamps = true;
    protected $fillable = array('id','title', 'item_id','price','calory','count_number','multiple');
    protected $visible = array('id','title', 'item_id','price','calory','count_number','multiple');

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

    public function extraDetails()
    {
        return $this->hasMany(Extradetail::class, 'extra_id')->where("hidden",0);
    }

}
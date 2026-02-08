<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
class Size extends Model 
{

    protected $table = 'sizes';
    public $timestamps = true;
    protected $fillable = array('id','title', 'price', 'item_id', 'calory');
    protected $visible = array('id','title', 'price', 'item_id', 'calory');

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

}
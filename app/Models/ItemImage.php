<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
class ItemImage extends Model 
{

    protected $table = 'items_images';
    public $timestamps = true;
    protected $fillable = array('image', 'item_id');
    protected $visible = array('image', 'item_id');

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
    }

}
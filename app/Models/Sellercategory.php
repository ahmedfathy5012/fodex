<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Seller;
class Sellercategory extends Model 
{

    protected $table = 'seller_category';
    public $timestamps = true;
    protected $fillable = array('id','seller_id', 'category_id');
    protected $visible = array('id','seller_id', 'category_id');
    public function category(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
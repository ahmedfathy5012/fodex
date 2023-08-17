<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Major;
use App\Models\Item;
class Subcategory extends Model 
{

    protected $table = 'subcategories';
    public $timestamps = true;
    protected $fillable = array('id','title', 'image', 'description', 'major_id','category_id');
    protected $visible = array('id','title', 'image', 'description', 'major_id','category_id');
  public function items()
    {
        return $this->hasMany(Item::class, 'subcategory_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    } public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

}
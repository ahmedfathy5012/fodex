<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Major;
use App\Models\Item;
use App\Models\Subcategory;
class Category extends Model 
{

    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('id','title', 'image', 'description', 'major_id');
    protected $visible = array('id','title', 'image', 'description', 'major_id');

    public function major()
    {
        return $this->belongsTo(Major::class, 'major_id');
    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    } public function items()
    {
        return $this->hasMany(Item::class, 'category_id');
    }

}
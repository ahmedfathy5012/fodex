<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seller;
use App\Models\Category;
class Major extends Model 
{

    protected $table = 'majors';
    public $timestamps = true;
    protected $fillable = array('id','title', 'description', 'image');
    protected $visible = array('id','title', 'description', 'image');

    public function categories()
    {
        return $this->hasMany(Category::class, 'major_id');
    }    public function sellers()
    {
        return $this->HasMany(Seller::class, 'major_id');
    }public function done_orders(){
        $done_orders = [];
        if(count($this->sellers) > 0){
            foreach($this->sellers as $seller){
                if(count($seller->done_orders) > 0){
            foreach($seller->done_orders as $order){ 
                $done_orders[] = $order;
            }
                }
            }
        }
        return collect($done_orders);
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuType extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'title',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class , 'seller_id','id');
    }

    public function items()
    {
        return $this->hasMany(Item::class , 'menu_type_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Extra;
class FavoriteSeller extends Model 
{

    protected $table = 'favorite_sellers';
    public $timestamps = true;
    protected $guarded = [];
}
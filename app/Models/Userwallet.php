<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userwallet extends Model 
{

    protected $table = 'userwallets';
    public $timestamps = true;
    protected $fillable = array('amount', 'user_id', 'walletmethod_id', 'source_seller_id', 'source_driver_id');
    protected $visible = array('amount', 'user_id', 'walletmethod_id', 'source_seller_id', 'source_driver_id');

    public function walletMethod()
    {
        return $this->belongsTo('Walletmethod', 'walletmethod_id');
    }

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }

}
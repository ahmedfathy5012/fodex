<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Walletmethod extends Model 
{

    protected $table = 'walletmethods';
    public $timestamps = true;
    protected $fillable = array('title');
    protected $visible = array('title');

    public function userWallets()
    {
        return $this->hasMany('Userwallet', 'walletmethod_id');
    }

}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model 
{

    protected $table = 'socials';
    public $timestamps = true;
    protected $fillable = array('facebook', 'instagram', 'twiter', 'seller_id');
    protected $visible = array('facebook', 'instagram', 'twiter', 'seller_id');

    public function seller()
    {
        return $this->belongsTo('Social', 'seller_id');
    }

}
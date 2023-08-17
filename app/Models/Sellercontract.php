<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sellercontract extends Model 
{

    protected $table = 'sellercontracts';
    public $timestamps = true;
    protected $fillable = array('id','from_day', 'to_day', 'percentage', 'paper_contract_image', 'employee_id', 'seller_id', 'notes');
    protected $visible = array('id','from_day', 'to_day', 'percentage', 'paper_contract_image', 'employee_id', 'seller_id', 'notes');

    public function marketing_employee()
    {
        return $this->belongsTo('Employee', 'employee_id');
    }

    public function seller()
    {
        return $this->belongsTo('Seller', 'seller_id');
    }

}
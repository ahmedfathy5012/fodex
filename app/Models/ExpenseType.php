<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpenseType extends Model
{
  protected $table = 'expenses_types';
    public $timestamps = true;
    protected $fillable = array('id','name');
    protected $visible = array('id','name');
}

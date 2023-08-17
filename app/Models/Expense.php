<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ExpenseType;
class Expense extends Model
{
      protected $table = 'expenses';
    public $timestamps = true;
  //  protected $guarded = [];
 public function expensetype(){
     return $this->belongsTo(ExpenseType::class,'expensestype_id');
 }
}

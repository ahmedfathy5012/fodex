<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;
use App\Models\ProblemReason;

class ProblemReasonOrder extends Model
{
      protected $table = 'problem_reason_orders';
    public $timestamps = true;
    protected $guarded = [];
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }public function problem_reason()
    {
        return $this->belongsTo(ProblemReason::class, 'problem_reason_id');
    }
}

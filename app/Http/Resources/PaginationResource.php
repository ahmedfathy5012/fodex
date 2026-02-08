<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\User;
use Carbon\Carbon;
class PaginationResource extends JsonResource
{
   
    public function toArray($request)
    {
     
      return [
            'current' => $this->currentPage(),
        'last' => $this->lastPage(),
               'count' => $this->count(),
    'total' => $this->total(),
    'prev'  => $this->previousPageUrl(),
    'next'  => $this->nextPageUrl(),
        ];
    }
}

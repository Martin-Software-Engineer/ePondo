<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Messages extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $from = $this->from()->select('id','username','avatar','email')->first();
        $fromtwo = $this->from->user->userinformation()->select('id')->first();
       
  

        $to = $this->to()->select('id','username','avatar','email')->first();

    
        return [
            'from' => $from,
            'fromtwo' => $fromtwo,
            'message' => $this->message,
            'seen' => $this->seen,
            'date' => $this->created_at->format('M d, Y')
        ];
    }
}

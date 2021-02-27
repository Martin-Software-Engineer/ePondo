<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\System;
class Jobseekers extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id, 
            'jobseeker_id' => System::GenerateFormattedId('J', $this->id),
            'name' => $this->name,
            'email' => $this->email
        ];
    }
}

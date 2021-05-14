<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\System;
class Service extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $duration = '';
        if($this->duration_hours > 1){
            $duration = $this->duration_hours.' Hours';
        }else{
            $duration = $this->duration_hours.' Hour';
        }

        if($this->duration_minutes > 1){
            $duration = $duration.' '.$this->duration_minutes.' Minutes';
        }
        
        return [
            'id' => $this->id,
            'service_id' => System::GenerateFormattedId('S', $this->id),
            'jobseeker_name' => $this->jobseeker->username,
            'jobseeker_id' => System::GenerateFormattedId('J', $this->jobseeker->id),
            'title' => $this->title,
            'categories' => $this->categories,
            'duration' => $duration
        ];
    }
}

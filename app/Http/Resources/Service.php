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
        return [
            'id' => $this->id,
            'service_id' => System::GenerateFormattedId('S', $this->id),
            'jobseeker_name' => $this->jobseeker->name,
            'jobseeker_id' => $this->jobseeker->id,
            'title' => $this->title,
            'categories' => $this->categories,
            'duration' => $this->duration
        ];
    }
}

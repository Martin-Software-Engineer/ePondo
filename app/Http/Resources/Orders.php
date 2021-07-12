<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\System;
class Orders extends JsonResource
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
        if($this->service->duration_hours > 1){
            $duration = $this->service->duration_hours.' Hours';
        }else{
            $duration = $this->service->duration_hours.' Hour';
        }

        if($this->service->duration_minutes > 1){
            $duration = $duration.' '.$this->service->duration_minutes.' Minutes';
        }

        return [
            'id' => $this->id,
            'order_id' => System::GenerateFormattedId('S', $this->id),
            'jobseeker_name' => $this->service->jobseeker->username,
            'jobseeker_id' => System::GenerateFormattedId('J', $this->service->jobseeker->id),
            'backer_name' => $this->backer->username,
            'backer_id' => System::GenerateFormattedId('B', $this->backer->id),
            'service_id' => $this->service->id,
            'service_title' => $this->service->title,
            'service_categories' => $this->service->categories,
            'service_date' => date('F d, Y', strtotime($this->details->render_date)),
            'service_price' => number_format($this->service->price),
            'service_location' => $this->details->delivery_address,
            'service_duration' => $duration,
            'has_jobseeker_feedback' => $this->hasjobseekerfeedback,
            'has_backer_feedback' => $this->hasbackerfeedback,
            'status' => System::StatusTextValue($this->status)
        ];
    }
}

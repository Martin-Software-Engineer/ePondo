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
        return [
            'id' => $this->id,
            'order_id' => System::GenerateFormattedId('S', $this->id),
            'jobseeker_name' => $this->service->jobseeker->name,
            'jobseeker_id' => System::GenerateFormattedId('J', $this->service->jobseeker->id),
            'backer_name' => $this->backer->name,
            'backer_id' => System::GenerateFormattedId('B', $this->backer->id),
            'service_title' => $this->service->title,
            'service_categories' => $this->service->categories,
            'service_date' => $this->created_at->format('M-d-Y'),
            'status' => System::StatusTextValue($this->status)
        ];
    }
}

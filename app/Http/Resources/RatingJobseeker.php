<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\System;
class RatingJobseeker extends JsonResource
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
            'rating_id' => System::GenerateFormattedId('RF', $this->id),
            'order_id' => System::GenerateFormattedId('S', $this->order->id),
            'service_title' => $this->order->service->title,
            'jobseeker_name' => $this->order->service->jobseeker->username,
            'jobseeker_id' => System::GenerateFormattedId('J', $this->order->service->jobseeker->id),
            'rating' => $this->rating,
            'feedback' => $this->feedback
        ];
    }
}

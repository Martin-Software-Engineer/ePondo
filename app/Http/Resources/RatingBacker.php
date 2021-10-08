<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\System;
class RatingBacker extends JsonResource
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
            'backer_name' => $this->order->backer->username,
            'backer_id' => System::GenerateFormattedId('B', $this->order->backer->id),
            'rating' => $this->rating,
            'feedback' => $this->feedback
        ];
    }
}

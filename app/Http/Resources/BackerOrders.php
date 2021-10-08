<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\System;
class BackerOrders extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $service = $this->service;
        return [
            'id' => $this->id,
            'order_id' => System::GenerateFormattedId('S', $this->id),
            'service' => (object)[
                'title' => $service->title,
                'categories' => $service->categories,
                'price' => 'Php '.number_format($service->price,2)
                
                                
            ],
            'date' => date('F d, Y', strtotime($this->details->render_date)),
            'status' => (object)[
                'code' => $this->status,
                'text' => System::StatusTextValue($this->status, true),
            ],
            'status_text' => System::StatusTextValue($this->status),
        ];
    }
}

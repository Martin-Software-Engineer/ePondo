<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\System;
use App\Models\Service;
class Invoice extends JsonResource
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
            'invoice_id' => System::GenerateFormattedId('I', $this->id),
            'jobseeker_name' => $this->order->service->jobseeker->name,
            'jobseeker_id' => System::GenerateFormattedId('J', $this->order->service->jobseeker->id),
            'backer_name' => $this->order->backer->name,
            'backer_id' => System::GenerateFormattedId('B', $this->order->backer->id),
            'service_title' => $this->order->service->title,
            'order_id' => System::GenerateFormattedId('SO', $this->order->id),
            'categories' => Service::find($this->order->service->id)->categories,
            'due_date' => $this->date_due
        ];
    }
}

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
            'jobseeker_name' => $this->order->service->jobseeker->userinformation->lastname.', '.$this->order->service->jobseeker->userinformation->firstname,
            'jobseeker_id' => System::GenerateFormattedId('J', $this->order->service->jobseeker->id),
            'backer_name' => $this->order->backer->userinformation->lastname.', '.$this->order->backer->userinformation->firstname, 
            'backer_id' => System::GenerateFormattedId('B', $this->order->backer->id),
            'service_title' => $this->order->service->title,
            'order_id' => System::GenerateFormattedId('SO', $this->order->id), /** ACTIONS COLUMN */
            'service_categories' => $this->order->service->categories,
            'due_date' => date('F d, Y', strtotime($this->date_due)),
            'status' => $this->status
        ];
    }
}

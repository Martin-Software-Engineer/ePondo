<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\System;

class Campaigns extends JsonResource
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
            'campaign_id' => System::GenerateFormattedId('C', $this->id),
            'jobseeker_name' => $this->jobseeker->username,
            'jobseeker_firstname' => $this->jobseeker->information->firstname,
            'jobseeker_lastname' => $this->jobseeker->information->lastname,
            'jobseeker_id' => System::GenerateFormattedId('J', $this->jobseeker->id),
            'status' => $this->status,
            'title' => $this->title,
            'categories' => $this->categories,
            'target_date' => date('m-d-y', strtotime($this->target_date)),
            'target_amount' => $this->target_amount,
            'amount_raised' => $this->donations()->sum('amount'),
        ];
    }
}

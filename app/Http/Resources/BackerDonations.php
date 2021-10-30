<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\System;
class BackerDonations extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $campaign = $this->campaign;
        return [
            'donation_id' => System::GenerateFormattedId('CD', $this->id),
            'title' => $campaign->title,
            'description' => $campaign->description,
            'categories' => $campaign->categories,
            'jobseeker_name' => $campaign->jobseeker->userinformation->firstname.' '.$campaign->jobseeker->userinformation->lastname,
            'date' => date('F d, Y', strtotime($this->created_at)),
            'amount' => 'Php '.number_format($this->amount,2),
            'message' => $this->message,
            'status' => $campaign->status
        ];
    }
}

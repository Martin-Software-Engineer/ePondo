<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\System;

class Donations extends JsonResource
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
            'donation_id' => System::GenerateFormattedId('CD', $this->id),
            'backer_name' => $this->backer->name,
            'backer_email' => $this->backer->email,
            'message' => $this->message,
            'amount' => $this->amount
        ];
    }
}

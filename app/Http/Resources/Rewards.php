<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\System;
class Rewards extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $total_points = $this->rewards->sum('points');
        return [
            'id' => $this->id,
            'jobseeker_id' => System::GenerateFormattedId('J', $this->id),
            'jobseeker_name' => $this->name,
            'reward_tier' => System::RewardsTier($total_points),
            'total_points' => $total_points
        ];
    }
}

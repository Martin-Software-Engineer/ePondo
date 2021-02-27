<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\System;
class UserList extends JsonResource
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
            'user_id' => (str_pad((int)$this->user_id + 1, 6, '0', STR_PAD_LEFT)),
            'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'user_level_id' => $this->user_level_id,
            'profile' => (!empty($this->profile)) ? url('images/profile/'.$this->profile) : '',
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
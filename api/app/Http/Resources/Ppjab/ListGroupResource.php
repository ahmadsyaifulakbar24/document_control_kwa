<?php

namespace App\Http\Resources\Ppjab;

use App\Http\Resources\PpjabResource;
use App\Models\Param;
use Illuminate\Http\Resources\Json\JsonResource;

class ListGroupResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'group' => $this->param
        ];
    }
}
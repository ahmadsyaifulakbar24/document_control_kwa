<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'keterangan' => $this->keterangan,
            'created_at' => \Carbon\Carbon::parse($this->created_at)->format('Y-m-d H:i:s')
        ];
    }
}
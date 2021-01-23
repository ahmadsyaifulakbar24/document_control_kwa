<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubProjectResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'name' => $this->name,
            'keterangan' => $this->keterangan,
            'file' => !empty($this->file) ? url('directory/sub_project/'.$this->file) : '',
            'user_id' => $this->user_id,
            'user' => new UserResource($this->user),
            'created_at' => \Carbon\Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => \Carbon\Carbon::parse($this->updated_at)->format('Y-m-d H:i:s')
        ];
    }
}
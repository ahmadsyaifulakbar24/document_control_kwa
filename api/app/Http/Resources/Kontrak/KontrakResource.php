<?php

namespace App\Http\Resources\Kontrak;

use Illuminate\Http\Resources\Json\JsonResource;

class KontrakResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'keterangan' => $this->keterangan,
            'amandemen' => !empty($this->amandemen) ? url('directory/kontrak/'.$this->amandemen) : NULL,
            'created_at' => \Carbon\Carbon::parse($this->created_at)->format('Y-m-d H:i:s')
        ];
    }
}
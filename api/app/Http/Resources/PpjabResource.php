<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PpjabResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'provinsi' => $this->provinsi,
            'kab_kota' => $this->kab_kota,
            'kecamatan' => $this->kecamatan,
            'keterangan' => $this->keterangan,
            'created_at' => \Carbon\Carbon::parse($this->created_at)->format('Y-m-d H:i:s')
        ];
    }
}
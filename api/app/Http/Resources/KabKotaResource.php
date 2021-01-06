<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KabKotaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'provinsi_id' => $this->provinsi_id,
            'kab_kota' => $this->kab_kota,
            'type' => $this->type,
            'ibu_kota' => $this->ibu_kota,
        ];
    }
}
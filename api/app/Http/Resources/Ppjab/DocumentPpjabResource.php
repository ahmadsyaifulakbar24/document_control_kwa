<?php

namespace App\Http\Resources\Ppjab;

use App\Http\Resources\PpjabResource;
use App\Models\Param;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentPpjabResource extends JsonResource
{
    public function toArray($request)
    {
        $group = Param::find($this->group_id);
        return [
            'id' => $this->id,
            'group' => [
                'id' => $group->id,
                'group' => $group->param,
            ],
            'name' => $this->name,
            'keterangan' => $this->keterangan,
            'file' => !empty($this->file) ? url('directory/document_ppjab/'.$this->file) : '',
            'created_at' => \Carbon\Carbon::parse($this->created_at)->format('Y-m-d H:i:s'),
            'ppjab' => new PpjabResource($this->ppjab)
        ];
    }
}
<?php

namespace App\Http\Resources\Kontrak;

use App\Models\KontrakProject;
use Illuminate\Http\Resources\Json\JsonResource;

class AmandemenResource extends JsonResource
{
    public function toArray($request)
    {
        $kontrak_project = KontrakProject::find($this->kontrak_project_id);
        return [
            'id' => $this->id,
            'kontrak_project' => new KontrakResource($kontrak_project),
            'name' => $this->name,
            'keterangan' => $this->keterangan,
            'file' => !empty($this->file) ? url('directory/kontrak/'.$this->file) : NULL,
            'created_at' => \Carbon\Carbon::parse($this->created_at)->format('Y-m-d H:i:s')
        ];
    }
}
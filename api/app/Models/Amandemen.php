<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Amandemen extends Model
{
    protected $table = 'amandemen';

    protected $fillable = [
        'kontrak_project_id',
        'name',
        'keterangan',
        'file'
    ];

    public function kontrak_project() 
    {
        return $this->belongsTo('App\Models\KontrakProject', 'kontrak_poroject_id');
    }
}

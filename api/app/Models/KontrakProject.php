<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KontrakProject extends Model
{
    protected $table = 'kontrak_projects';

    protected $fillable = [
        'name',
        'keterangan',
        'amandemen'
    ];

    public function amandemen()
    {
        return $this->hasMany('App\Models\Amandemen', 'kontrak_project_id');
    }
}

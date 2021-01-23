<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';

    protected $fillable = [
        'name',
        'keterangan'
    ];
 
    public function sub_project() {
        return $this->hasMany('App\Models\SubProject', 'project_id');
    }
}

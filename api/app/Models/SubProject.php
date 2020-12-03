<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubProject extends Model
{
    protected $table = 'sub_projects';

    protected $fillable = [
        'project_id',
        'name',
        'keterangan',
        'file'
    ];
}

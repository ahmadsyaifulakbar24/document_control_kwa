<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubProject extends Model
{
    protected $table = 'sub_projects';

    protected $fillable = [
        'user_id',
        'project_id',
        'name',
        'keterangan',
        'file'
    ];

    public function user() 
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}

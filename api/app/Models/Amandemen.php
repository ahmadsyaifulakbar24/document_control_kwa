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
}

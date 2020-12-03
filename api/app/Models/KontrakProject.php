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
}

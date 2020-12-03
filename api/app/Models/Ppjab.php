<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ppjab extends Model
{
    protected $table = 'ppjab';

    protected $fillable = [
        'name',
        'keterangan'
    ];
}

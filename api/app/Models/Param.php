<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Param extends Model
{
    protected $table = 'params';

    protected $fillable = [
        'category_param',
        'param_id',
        'param',
        'order',
        'active'
    ];

    public $timestamps = false;
}

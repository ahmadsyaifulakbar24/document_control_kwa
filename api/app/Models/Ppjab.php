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

    public function document_ppjab() {
        return $this->hasMany('App\Models\DocumentPpjab', 'ppjab_id');
    }
}

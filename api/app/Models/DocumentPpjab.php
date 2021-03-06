<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentPpjab extends Model
{
    protected $table = 'document_ppjab';

    protected $fillable = [
        'ppjab_id',
        'group_id',
        'name',
        'keterangan',
        'file'
    ];

    public function ppjab() {
        return $this->belongsTo('App\Models\Ppjab', 'ppjab_id');
    }
}

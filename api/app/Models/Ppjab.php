<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ppjab extends Model
{
    protected $table = 'ppjab';

    protected $fillable = [
        'name',
        'provinsi_id',
        'kab_kota_id',
        'kecamatan',
        'keterangan'

    ];

    public function document_ppjab() {
        return $this->hasMany('App\Models\DocumentPpjab', 'ppjab_id');
    }

    public function provinsi() {
        return $this->belongsTo('App\Models\Provinsi', 'provinsi_id');
    }

    public function kab_kota() {
        return $this->belongsTo('App\Models\KabKota', 'kab_kota_id');
    }
}

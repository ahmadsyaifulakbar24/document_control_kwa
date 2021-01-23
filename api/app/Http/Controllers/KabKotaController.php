<?php

namespace App\Http\Controllers;

use App\Http\Resources\KabKotaResource;
use App\Models\KabKota;
use App\Models\Provinsi;

class KabKotaController extends Controller
{
    public function __construct()
    {
        //
    }

    public function get_by_provinsi_id($provinsi_id)
    {
        $provinsi = KabKota::where('provinsi_id', $provinsi_id)->get();
        return KabKotaResource::collection($provinsi);
    }
}

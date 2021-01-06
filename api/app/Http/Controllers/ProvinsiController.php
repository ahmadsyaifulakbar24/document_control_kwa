<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProvinsiResource;
use App\Models\Provinsi;

class ProvinsiController extends Controller
{
    public function __construct()
    {
        //
    }

    public function getAll()
    {
        $provinsi = Provinsi::all();
        return ProvinsiResource::collection($provinsi);
    }
}

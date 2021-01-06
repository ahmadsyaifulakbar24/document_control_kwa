<?php

namespace App\Http\Controllers\Ppjab\Ppjab;

use App\Http\Controllers\Controller;
use App\Http\Resources\PpjabResource;
use App\Models\Ppjab;
use Illuminate\Http\Request;

class CreatePpjabController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'provinsi_id' =>  ['required', 'exists:provinsi,id'],
            'kab_kota_id' =>  ['required', 'exists:kab_kota,id'],
            'kecamatan' => ['required', 'string'],
            'keterangan' => ['required', 'string']
        ]);

        $input = $request->all();
        $ppjab = Ppjab::create($input);
        return new PpjabResource($ppjab);
    }
}

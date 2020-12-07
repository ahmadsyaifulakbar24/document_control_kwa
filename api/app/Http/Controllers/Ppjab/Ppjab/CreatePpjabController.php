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
            'keterangan' => ['required', 'string']
        ]);

        $input = $request->all();
        $ppjab = Ppjab::create($input);
        return new PpjabResource($ppjab);
    }
}

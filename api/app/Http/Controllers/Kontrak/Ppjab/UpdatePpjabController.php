<?php

namespace App\Http\Controllers\Kontrak\Ppjab;

use App\Http\Controllers\Controller;
use App\Http\Resources\PpjabResource;
use App\Models\Ppjab;
use Illuminate\Http\Request;

class UpdatePpjabController extends Controller
{
    public function __invoke(Request $request, $ppjab_id)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'keterangan' => ['required', 'string']
        ]);

        $ppjab = Ppjab::find($ppjab_id);
        if($ppjab) {
            $input = $request->all();
            $ppjab->update($input);
            return new PpjabResource($ppjab);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

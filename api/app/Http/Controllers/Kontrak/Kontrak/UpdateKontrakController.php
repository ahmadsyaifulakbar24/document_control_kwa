<?php

namespace App\Http\Controllers\Kontrak\Kontrak;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\Kontrak\KontrakResource;
use App\Models\KontrakProject;
use Illuminate\Http\Request;

class UpdateKontrakController extends Controller
{
    public function __invoke(Request $request, $kontrak_id)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'keterangan' => ['required', 'string'],
            'amandemen' => ['nullable', 'max:10000', 'mimes:doc,docx,pdf']
        ]);
        $kontrak = KontrakProject::find($kontrak_id);
        if($kontrak) {
            $input = $request->all();
            if($request->hasFile('amandemen')) {
                $input['amandemen'] = FileHelpers::uploadFile('directory/kontrak/', $request->amandemen);
            }
    
            $kontrak->update($input);
            return new KontrakResource($kontrak);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

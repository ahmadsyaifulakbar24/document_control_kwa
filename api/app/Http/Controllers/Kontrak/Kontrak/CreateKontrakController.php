<?php

namespace App\Http\Controllers\Kontrak\Kontrak;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\Kontrak\KontrakResource;
use App\Models\KontrakProject;
use Illuminate\Http\Request;

class CreateKontrakController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'keterangan' => ['required', 'string'],
            'amandemen' => ['nullable', 'max:10000', 'mimes:doc,docx,pdf']
        ]);

        $input = $request->all();
        if($request->hasFile('amandemen')) {
            $input['amandemen'] = FileHelpers::uploadFile('directory/kontrak/', $request->amandemen);
        }

        $kontrak = KontrakProject::create($input);
        return new KontrakResource($kontrak);
    }
}

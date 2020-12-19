<?php

namespace App\Http\Controllers\Kontrak\Amandemen;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\Kontrak\AmandemenResource;
use App\Models\Amandemen;
use Illuminate\Http\Request;

class CreateAmandemenController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'kontrak_project_id' => ['required', 'exists:kontrak_projects,id'],
            'name' => ['required', 'string'],
            'keterangan' => ['required', 'string'],
            'file' => ['required', 'max:10000', 'mimes:doc,docx,pdf']
        ]);
        $input = $request->all();
        if($request->hasFile('file')) {
            $input['file'] = FileHelpers::uploadFile('directory/kontrak/', $request->file);
        }
        $amandemen = Amandemen::create($input);
        return new AmandemenResource($amandemen);
    }
}

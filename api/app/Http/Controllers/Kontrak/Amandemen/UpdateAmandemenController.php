<?php

namespace App\Http\Controllers\Kontrak\Amandemen;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\Kontrak\AmandemenResource;
use App\Models\Amandemen;
use Illuminate\Http\Request;

class UpdateAmandemenController extends Controller
{
    public function __invoke(Request $request, $amandemen_id)
    {
        $this->validate($request, [
            'kontrak_project_id' => ['required', 'exists:kontrak_projects,id'],
            'name' => ['required', 'string'],
            'keterangan' => ['required', 'string'],
            'file' => ['nullable', 'max:10000', 'mimes:doc,docx,pdf']
        ]);
        $amandemen = Amandemen::find($amandemen_id);
        if($amandemen) {
            $input = $request->all();
            if($request->hasFile('file')) {
                $input['file'] = FileHelpers::uploadFile('directory/kontrak/', $request->file);
            }
            $amandemen->update($input);
            return new AmandemenResource($amandemen);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

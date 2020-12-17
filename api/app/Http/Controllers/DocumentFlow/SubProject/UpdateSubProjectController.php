<?php

namespace App\Http\Controllers\DocumentFlow\SubProject;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubProjectResource;
use App\Models\SubProject;
use Illuminate\Http\Request;

class UpdateSubProjectController extends Controller
{
    public function __invoke(Request $request, $sub_project_id)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'keterangan' => ['required', 'string']
        ]);

        $sub_project = SubProject::find($sub_project_id);
        if($sub_project) {
            $input = $request->all();
            $sub_project->update($input);
            return new SubProjectResource($sub_project);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

<?php

namespace App\Http\Controllers\DocumentFlow\SubProject;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubProjectResource;
use App\Models\SubProject;
use Illuminate\Http\Request;

class UploadFileSubProjectController extends Controller
{
    public function __invoke(Request $request, $sub_project_id)
    {
        $this->validate($request, [
            'file' => ['required', 'max:10000', 'mimes:doc,docx,pdf']
        ]);
        $sub_project = SubProject::find($sub_project_id);
        if($sub_project) {
            if(!empty($sub_project->file)) {
                FileHelpers::removeFile('directory/sub_project/'.$sub_project->file);
            }
            $input['file'] = FileHelpers::uploadFile('directory/sub_project/', $request->file);
            $sub_project->update($input);
            return new SubProjectResource($sub_project);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

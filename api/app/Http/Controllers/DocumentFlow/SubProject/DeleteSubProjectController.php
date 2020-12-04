<?php

namespace App\Http\Controllers\DocumentFlow\SubProject;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Models\SubProject;

class DeleteSubProjectController extends Controller
{
    public function __invoke($sub_project_id)
    {
        $sub_project = SubProject::find($sub_project_id);
        if($sub_project) {
            if(!empty($sub_project->file)) {
                FileHelpers::removeFile('directory/sub_project/'.$sub_project->file);
            }
            $sub_project->delete();
            return response()->json([
                'message' => 'delete success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

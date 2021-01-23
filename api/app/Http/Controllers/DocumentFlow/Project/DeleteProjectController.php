<?php

namespace App\Http\Controllers\DocumentFlow\Project;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\SubProject;
use Illuminate\Http\Request;

class DeleteProjectController extends Controller
{
    public function __invoke($project_id)
    {
        $project = Project::find($project_id);
        if($project) {
            $sub_project = SubProject::where('project_id', $project_id)->get();
            foreach($sub_project as $sub) {
                if(!empty($sub->file)) {
                    FileHelpers::removeFile('directory/sub_project/'.$sub->file);
                }
            }
            $project->delete();
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

<?php

namespace App\Http\Controllers\DocumentFlow\SubProject;

use App\Http\Controllers\Controller;
use App\Http\Resources\SubProjectResource;
use App\Models\Project;
use App\Models\SubProject;

class GetSubProjectController extends Controller
{
    public function get_by_project($project_id)
    {
        $project = Project::find($project_id);
        if($project) {
            $sub_project = SubProject::where('project_id', $project_id)->get();
            return SubProjectResource::collection($sub_project);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }

    public function get_by_id($sub_project_id) 
    {
        $sub_project = SubProject::find($sub_project_id);
        if($sub_project) {
            return new SubProjectResource($sub_project);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

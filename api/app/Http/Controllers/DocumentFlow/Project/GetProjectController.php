<?php

namespace App\Http\Controllers\DocumentFlow\Project;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class GetProjectController extends Controller
{
    public function get_all()
    {
        $project = Project::orderBy('id', 'DESC')->paginate(10);
        return ProjectResource::collection($project);
    }

    public function get_by_id($project_id)
    {
        $project = Project::find($project_id);
        if($project) {
            return new ProjectResource($project);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

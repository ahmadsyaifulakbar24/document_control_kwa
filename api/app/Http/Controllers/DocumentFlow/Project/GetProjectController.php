<?php

namespace App\Http\Controllers\DocumentFlow\Project;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\SubProject;
use Illuminate\Http\Request;

class GetProjectController extends Controller
{
    public function get_all(Request $request)
    {
        $user_level_id = $request->user()->user_level_id;
        if($user_level_id == 102 || $user_level_id == 103) {
            $user_id = $request->user()->id;
            $project = SubProject::select('a.id', 'a.name', 'a.keterangan', 'a.created_at', 'a.updated_at')->where('user_id', $user_id)
                                ->leftJoin('projects as a', 'sub_projects.project_id', '=', 'a.id')
                                ->groupBy('project_id')->paginate(10);
        } else {
            $project = Project::orderBy('id', 'DESC')->paginate(10);
        }
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

<?php

namespace App\Http\Controllers\DocumentFlow\Project;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class UpdateProjectController extends Controller
{
    public function __invoke(Request $request, $project_id)
    {
        $project = Project::find($project_id);
        if($project) {
            $this->validate($request, [
                'name' => ['required', 'string'],
                'keterangan' => ['required', 'string']
            ]);
            $input = $request->all();
            $project->update($input);
            return new ProjectResource($project);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

<?php

namespace App\Http\Controllers\DocumentFlow\SubProject;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class CreateSubProjectController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'project_id' => ['required', 'exists:projects,id'],
            'sub_project' => ['required', 'array'],
            'sub_project.*.name' => ['required', 'string'],
            'sub_project.*.keterangan' => ['required', 'string']
        ]);

        $project = Project::find($request->project_id);
        $sub_project_input = $request->sub_project;
        $project->sub_project()->createMany($sub_project_input);
        return response()->json([
            'message' => 'success create sub project'
        ], 200);
    }
}

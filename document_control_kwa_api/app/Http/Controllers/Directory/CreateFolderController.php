<?php

namespace App\Http\Controllers\Directory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateFolderController extends Controller
{
    public function __construct()
    {
        //
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'folder_name' => ['required', 'string']
        ]);

        $folder_name = $request->folder_name;
        $path = 'directory/'.$folder_name.'/';
        if(!is_dir($path)) {
            mkdir($path , 0777, true);
            return response()->json([
                'message' => 'create folder success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'the directory ' .$path. ' already exists'
            ], 200);
        }
    }
}

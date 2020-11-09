<?php

namespace App\Http\Controllers\Directory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteFolderController extends Controller
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
        if(is_dir($path)) {
            $this->xrmdir($path);
            return response()->json([
                'message' => 'success delete directory ' .$path
            ], 200);
        } else {
            return response()->json([
                'message' => 'the directory ' .$path. ' not exists'
            ], 200);
        }
    }

    public function xrmdir($path)
    {
        $items = glob($path."/*");
        foreach($items as $item) {
            is_dir($item) ? $this->xrmdir($item) : unlink($item);
        }
        rmdir($path);
        return;
    }
}

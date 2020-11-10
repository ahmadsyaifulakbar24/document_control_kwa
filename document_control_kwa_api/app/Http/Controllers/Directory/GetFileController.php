<?php

namespace App\Http\Controllers\Directory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetFileController extends Controller
{
    public function __construct()
    {
        //
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'file_path' => ['required', 'string']
        ]);
        
        $file_path = $request->file_path;
        $file = 'directory/'.$file_path;
        if(file_exists($file)) {
            return response()->json([
                'file' => url($file)
            ], 200);
        } else {
            return response()->json([
                'message' => 'file not found'
            ], 200);
        }
    }
}

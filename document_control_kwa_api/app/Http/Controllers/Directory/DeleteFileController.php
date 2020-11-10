<?php

namespace App\Http\Controllers\Directory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteFileController extends Controller
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
        $remove_file = $this->removeFile($file_path);
        if($remove_file) {
            return response()->json([
                'message' => $remove_file
            ], 200);
        }
    }

    public function removeFile($file_path)
    {
        $path = 'directory/'.$file_path;
        if(file_exists($path)) {
            unlink($path);
            $message = "success delete file";
        } else {
            $message = "file not found";
        }
        return $message;
    }
}

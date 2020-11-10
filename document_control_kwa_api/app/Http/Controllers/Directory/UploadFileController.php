<?php

namespace App\Http\Controllers\Directory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadFileController extends Controller
{
    public function __construct()
    {
        //
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'file' => ['required', 'file'],
            'path' => ['required','string']
        ]);
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $path = 'directory/'.$request->path.'/';
            if(is_dir($path)) {
                $file_name = $this->uploadFile($path, $file);
                if($file_name) {
                    return response()->json([
                        'message' => 'upload file success'
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'upload file failed'
                    ], 500);
                }
            } else {
                return response()->json([
                    'message' => 'path not found'
                ], 500);
            }
        }
    }

    public function uploadFile($path, $requestFile)
    {
        $couter = 0;
        $ext = $requestFile->getClientOriginalExtension();
        $original_name = $requestFile->getClientOriginalName();
        
        if($requestFile->isValid()) {
            $new_name = $original_name;
            while(file_exists($path.$new_name)) {
                $couter++;
                $new_name = $original_name." (".$couter.").".$ext;
            }
            $requestFile->move($path, $new_name);
            return $new_name;
        }
    }
}

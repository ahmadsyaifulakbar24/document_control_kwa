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
            'folder_path' => ['required','string']
        ]);
        if($request->hasFile('file')) {
            $file = $request->file('file');
            $path = 'directory/'.$request->folder_path.'/';
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
        $name_of_upload = $requestFile->getClientOriginalName();
        $original_name = pathinfo($name_of_upload, PATHINFO_FILENAME);
        $ext = $requestFile->getClientOriginalExtension();
        
        if($requestFile->isValid()) {
            while(file_exists($path.$name_of_upload)) {
                $couter++;
                $name_of_upload = $original_name." (".$couter.").".$ext;
            }
            $requestFile->move($path, $name_of_upload);
            return $name_of_upload;
        }
    }
}

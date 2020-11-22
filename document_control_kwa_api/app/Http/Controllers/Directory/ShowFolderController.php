<?php

namespace App\Http\Controllers\Directory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowFolderController extends Controller
{
    public function __construct()
    {
        //
    }

    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'folder_path' => ['nullable', 'string']
        ]);

        $folder_path = $request->folder_path;
        $cek_path = $folder_path ? $folder_path.'/' : '';
        $path = 'directory/'.$cek_path;
        if(is_dir($path)) {
            // return array_slice(scandir($path), 2);
            $files = array_diff(scandir($path), array('.', '..'));
            $result = [];
            foreach ($files as $entry) if($entry !== basename(__FILE__)) {
                $i = $path.$entry;
                $stat = stat($i);
                $result[] = [
                    'mtime' => $stat['mtime'],
                    'size' => $stat['size'],
                    'name' => basename($i),
                    'path' => preg_replace('@^\./@', '', substr($i,10)),
                    'is_dir' => is_dir($i),
                    // 'is_deleteable' => (!is_dir($i) && is_writable($path)) || (is_dir($i) && is_writable($path) && is_recursively_deleteable($i)),
                    'is_readable' => is_readable($i),
                    'is_writable' => is_writable($i),
                    'is_executable' => is_executable($i),
                ];
            }
            return response()->json([
                'is_writable' => is_writable($path),
                'data' => $result
            ]);
        } else {
            return response()->json([
                'message' => 'Not a Directory'
            ], 412);
        }
    }
}

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
        $path = 'directory/'.$folder_path.'/';
        return array_slice(scandir($path), 2);
    }
}

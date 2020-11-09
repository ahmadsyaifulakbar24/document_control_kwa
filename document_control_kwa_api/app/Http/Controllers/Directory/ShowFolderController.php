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
            'folder_name' => ['nullable', 'string']
        ]);

        $folder_name = $request->folder_name;
        $path = 'directory/'.$folder_name.'/';
        return array_slice(scandir($path), 2);
    }
}

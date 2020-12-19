<?php

namespace App\Http\Controllers\Kontrak\Kontrak;


use App\Http\Controllers\Controller;
use App\Http\Resources\Kontrak\KontrakResource;
use App\Models\KontrakProject;

class GetKontrakController extends Controller
{
    public function get_all() 
    {
        $kontrak = KontrakProject::orderBy('id', 'DESC')->paginate(10);
        return KontrakResource::collection($kontrak);
    }

    public function get_by_id($kontrak_id) 
    {
        $kontrak = KontrakProject::find($kontrak_id);
        if($kontrak) {
            return new KontrakResource($kontrak);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

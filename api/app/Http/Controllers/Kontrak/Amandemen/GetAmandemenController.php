<?php

namespace App\Http\Controllers\Kontrak\Amandemen;

use App\Http\Controllers\Controller;
use App\Http\Resources\Kontrak\AmandemenResource;
use App\Models\Amandemen;
use App\Models\KontrakProject;

class GetAmandemenController extends Controller
{
    public function get_all($kontrak_id)
    {
        $kontrak = KontrakProject::find($kontrak_id);
        if($kontrak) {
            $amandemen = Amandemen::where('kontrak_project_id', $kontrak_id)->get();
            return AmandemenResource::collection($amandemen);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

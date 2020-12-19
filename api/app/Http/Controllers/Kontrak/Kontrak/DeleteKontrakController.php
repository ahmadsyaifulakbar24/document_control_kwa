<?php

namespace App\Http\Controllers\Kontrak\Kontrak;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Models\Amandemen;
use App\Models\KontrakProject;

class DeleteKontrakController extends Controller
{
    public function __invoke($kontrak_id)
    {
        $kontrak = KontrakProject::find($kontrak_id);
        if($kontrak) {
            $cek_amandemen = Amandemen::where('kontrak_project_id', $kontrak_id)->count();
            if($cek_amandemen <= 0) {
                if(!empty($kontrak->amandemen)) {
                    FileHelpers::removeFile('directory/kontrak/'.$kontrak->amandemen);
                }
                $kontrak->delete();
                return response()->json([
                    'message' => 'delete success'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'cannot delete kontrak project because there is a file'
                ], 422);
            }
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

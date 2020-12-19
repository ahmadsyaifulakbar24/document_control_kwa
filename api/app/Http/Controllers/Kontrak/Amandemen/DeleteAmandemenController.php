<?php

namespace App\Http\Controllers\Kontrak\Amandemen;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Models\Amandemen;

class DeleteAmandemenController extends Controller
{
    public function __invoke($amandemen_id)
    {
        $amandemen = Amandemen::find($amandemen_id);

        if($amandemen) {
            FileHelpers::removeFile('directory/kontrak/'.$amandemen->file);
            $amandemen->delete();
            return response()->json([
                'message' => 'delete success'
            ], 200);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

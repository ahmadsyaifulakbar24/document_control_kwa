<?php

namespace App\Http\Controllers\Kontrak\Ppjab;

use App\Http\Controllers\Controller;
use App\Models\DocumentPpjab;
use App\Models\Ppjab;

class DeletePpjabController extends Controller
{
    public function __invoke($ppjab_id)
    {
        $ppjab = Ppjab::find($ppjab_id);
        if($ppjab) {
            $cek = DocumentPpjab::where('ppjab_id', $ppjab_id)->count();
            if($cek < 1) {
                $ppjab->delete();
                return response()->json([
                    'message' => 'delete success'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'cannot delete ppjab because there are documents in this ppjab' 
                ], 422);
            }
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }    
}

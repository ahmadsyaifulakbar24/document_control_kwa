<?php

namespace App\Http\Controllers\Ppjab\Ppjab;

use App\Http\Controllers\Controller;
use App\Http\Resources\PpjabResource;
use App\Models\Ppjab;

class GetPpjabController extends Controller
{
    public function get_all()
    {
        $ppjab = Ppjab::paginate(10);
        return PpjabResource::collection($ppjab);
    }

    public function get_by_id($ppjab_id)
    {
        $ppjab = Ppjab::find($ppjab_id);
        if($ppjab) {
            return new PpjabResource($ppjab);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

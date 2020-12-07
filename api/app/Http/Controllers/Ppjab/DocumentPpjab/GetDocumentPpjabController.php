<?php

namespace App\Http\Controllers\Ppjab\DocumentPpjab;

use App\Http\Controllers\Controller;
use App\Http\Resources\Ppjab\DocumentPpjabResource;
use App\Http\Resources\Ppjab\ListGroupResource;
use App\Models\DocumentPpjab;
use App\Models\Param;
use App\Models\Ppjab;

class GetDocumentPpjabController extends Controller
{
    public function list_group()
    {
        $group = Param::where([['category_param', 'group_document_ppjab'], ['active', 1]])->orderBy('order', 'ASC')->get();
        return ListGroupResource::collection($group);
    }

    public function get_by_id($document_ppjab_id)
    {
        $document_ppjab = DocumentPpjab::find($document_ppjab_id);
        return new DocumentPpjabResource($document_ppjab);
    }

    public function get_by_ppjab_group($ppjab_id, $group_id)
    {
        $ppjab = Ppjab::find($ppjab_id);
        if($ppjab) {
            $document_ppjab = DocumentPpjab::where([['ppjab_id', $ppjab_id], ['group_id', $group_id]])->get();
            return DocumentPpjabResource::collection($document_ppjab);
        } else {
            return response()->json([
                'message' => 'data not found'
            ], 404);
        }
    }
}

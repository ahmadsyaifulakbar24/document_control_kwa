<?php

namespace App\Http\Controllers\Ppjab\DocumentPpjab;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Models\DocumentPpjab;

class DeleteDocumentPpjabController extends Controller
{
    public function __invoke($document_ppjab_id)
    {
        $document_ppjab = DocumentPpjab::find($document_ppjab_id);
        if($document_ppjab) {
            if(!empty($document_ppjab->file)) {
                FileHelpers::removeFile('directory/document_ppjab/'.$document_ppjab->file);
            }
            $document_ppjab->delete();
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

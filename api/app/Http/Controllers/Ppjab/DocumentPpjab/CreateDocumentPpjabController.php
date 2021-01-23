<?php

namespace App\Http\Controllers\Ppjab\DocumentPpjab;

use App\Helpers\FileHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\Ppjab\DocumentPpjabResource;
use App\Models\Ppjab;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CreateDocumentPpjabController extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'ppjab_id' => ['required', 'exists:ppjab,id'],
            'group_id' => [
                'required',
                Rule::exists('params', 'id')->where(function($query) {
                    $query->where('category_param', 'group_document_ppjab');
                })
            ],
            'name' => ['required', 'string'],
            'keterangan' => ['required', 'string'],
            'file' => ['required', 'max:10000', 'mimes:doc,docx,pdf']
        ]);
        
        $ppjab = Ppjab::find($request->ppjab_id);
        $input = $request->all();
        if($request->hasFile('file')) {
            $input['file'] = FileHelpers::uploadFile('directory/document_ppjab/', $request->file);
        }

        $document_ppjab =  $ppjab->document_ppjab()->create($input);
        return new DocumentPpjabResource($document_ppjab);
    }
}

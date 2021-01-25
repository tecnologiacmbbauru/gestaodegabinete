<?php

namespace App\Exports;

use App\Models\documento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class documentosExport implements FromView
{
    private $documentos;

    public function __construct($documentos){
        $this->documentos = $documentos;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('pdf.documentoExcelExport', [
            'documentos' => $this->documentos
        ]);
    }
}

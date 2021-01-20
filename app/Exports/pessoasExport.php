<?php

namespace App\Exports;

use App\Models\pessoa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class pessoasExport implements FromView
{
    
    public function view(): View
    {
        return view('pdf.pessoaExcelExport', [
            'pessoas' => pessoa::all()
        ]);
    }
}

<?php

namespace App\Exports;

use App\Models\atendimento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
//
//use Maatwebsite\Excel\Concerns\FromQuery;
//use Maatwebsite\Excel\Concerns\Exportable;
class atendimentosExport implements FromView
{

    public function view(): View
    {
        return view('pdf.atendimentoExcelExport', [
            'atendimentos' => atendimento::all()
        ]);
    }

}  

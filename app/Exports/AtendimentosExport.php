<?php

namespace App\Exports;

use App\Models\Atendimento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
//
//use Maatwebsite\Excel\Concerns\FromQuery;
//use Maatwebsite\Excel\Concerns\Exportable;
class AtendimentosExport implements FromView
{
    private $atendimentos;

    public function __construct($atendimentos){
        $this->atendimentos = $atendimentos;
    }

    public function view(): View
    {
        return view('pdf.atendimentoExcelExport', [
            'atendimentos' =>$this->atendimentos
        ]);
    }

}

<?php

namespace App\Exports;

use App\Models\Pessoa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PessoasExport implements FromView
{
    private $pessoas;

    public function __construct($pessoas){
        $this->pessoas = $pessoas;
    }

    public function view(): View
    {
        return view('pdf.pessoaExcelExport', [
            'pessoas' => $this->pessoas
        ]);
    }

}

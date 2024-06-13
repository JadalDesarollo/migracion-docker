<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoicesExport implements FromView
{
    public function view(): View
    {
        return view('testExcel', [
            'data' => 'ssssss' // Corrige la forma en que pasas los datos a la vista
        ]);
    }
}

class ReportDayExport implements FromView
{
    public function view(): View
    {
        return view('reportpdf.reportDay', [
            'data' => 'ssssss' // Corrige la forma en que pasas los datos a la vista
        ]);
    }
}


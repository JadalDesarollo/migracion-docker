<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\InvoicesExport; // Asegúrate de importar la clase de exportación
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportDayExport;
use Illuminate\Support\Facades\DB;
use App\Models\Establishment;
class ExcelController extends Controller
{
    public function index()
    {
        return Excel::download(new InvoicesExport, 'invoices.xlsx');
    }

    public function reportDay(Request $request)
    {
        $desde = $request->input('desde');
        $hasta = $request->input('hasta');
        $local = $request->input('local');
        $user = $request->input('user');

        $establishment = Establishment::where('code', $local)->first();

        // Cabecera
        $headers = DB::select('EXEC SP_RPT_ACUMULADO_XDIA_PRODUCTO ?, ?, ?', [$desde, $hasta, $local]);

        foreach ($headers as $header) {
            $header->cdarticulo = trim($header->cdarticulo);
            $header->dsarticulo1 = trim($header->dsarticulo1);
        }

        // Contenido
        $contents = DB::select('SP_RPT_ACUMULADO_XDIA_LISTA ?, ?, ?', [$desde, $hasta, $local]);
        foreach ($contents as $content) {
            $content->cdarticulo = rtrim($content->cdarticulo);
            $content->dsarticulo1 = rtrim($content->dsarticulo1);
        }

        // Totales
        $results = DB::select('SP_RPT_ACUMULADO_XDIA_RESUMEN ?, ?, ?', [$desde, $hasta, $local]);

        $data = [
            'title' => 'Reportes diarios',
            'date' => date('d/m/Y'),
            'header' => $headers,
            'content' => $contents,
            'desde' => $desde,
            'hasta' => $hasta,
            'local' => $local,
            'result' => $results,
            'user' => $user,
            'establishment' => $establishment->description,
        ];

        // Generar un archivo Excel
        return Excel::download(new ReportDayExport($data), 'invoices.xlsx');
    }
}

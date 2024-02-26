<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Exports\InvoicesExport; // Asegúrate de importar la clase de exportación
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportDayExport;
use App\Exports\ReportInvoiceExport;
use App\Exports\ReportSaleExport;
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


    public function reportAccumulatedDayExcel(Request $request)
    {
        try {
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
            $local = $request->input('local');

            $startDate = \DateTime::createFromFormat('d-m-Y', $startDate);
            $endDate = \DateTime::createFromFormat('d-m-Y', $endDate);

            //SELECT * FROM rpt_list_product_sales_accumulate_by_day();
            // SELECT* FROM  rpt_list_sales_accumulate_by_day();
            // SELECT* FROM rpt_list_resumen_sales_accumulate_by_day();


            //cabecera
            // Verifica si startDate y endDate están vacíos y asigna null en ese caso
            if (empty($startDate)) {
                $startDate = null;
            }
            if (empty($endDate)) {
                $endDate = null;
            }
            // Llama a la función almacenada utilizando la sintaxis correcta para PostgreSQL
            $headers = DB::select('SELECT * FROM rpt_list_product_sales_accumulate_by_day(?, ?, ?)', [$startDate, $endDate, $local]);

            foreach ($headers as $header) {
                $header->id_product_v = trim($header->id_product_v);
                $header->product_name_v = trim($header->product_name_v);
            }

            $contents = DB::select('SELECT * FROM rpt_list_sales_accumulate_by_day(?, ?, ?)', [$startDate, $endDate, $local]);

            foreach ($contents as $content) {
                $content->id_product_v = rtrim($content->id_product_v);
                $content->product_name_v = rtrim($content->product_name_v);
            }

            $results = DB::select('SELECT * FROM rpt_list_resumen_sales_accumulate_by_day(?, ?, ?)', [$startDate, $endDate, $local]);



            //contenido

            if (empty($local)) {
                $local = 'Todos';
            }

            $data = [
                'title' => 'Reportes acumulado diario',
                'date' => date('d/m/Y'),
                'header' => $headers,
                'desde' => $startDate->format('d/m/Y'),
                'hasta' => $endDate->format('d/m/Y'),
                'establishment' => $local,
                'content' => $contents,
                'result' => $results,
                'user' => 'usuarioTest',
            ];

            // Generar un archivo Excel
            return Excel::download(new ReportDayExport($data), 'invoices.xlsx');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function reportInvoice(Request $request)
    {
        try {
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
            $local = $request->input('local');

            $startDate = \DateTime::createFromFormat('d-m-Y', $startDate);
            $endDate = \DateTime::createFromFormat('d-m-Y', $endDate);

            // Verifica si startDate y endDate están vacíos y asigna null en ese caso
            if (empty($startDate)) {
                $startDate = null;
            }
            if (empty($endDate)) {
                $endDate = null;
            }

            $clientName = null;
            $documenNumber = null;
            $situation = null;

            // Consulta SQL corregida
            $contents = DB::select('SELECT * FROM rtp_document_report(?, ?, ?, ?, ?)', [$clientName, $documenNumber, $startDate, $endDate, $situation]);

            //contenido
            $data = [
                'title' => 'Reportes de facturas',
                'date' => date('d/m/Y'),
                'desde' => $startDate ? $startDate->format('d/m/Y') : '',
                'hasta' => $endDate ? $endDate->format('d/m/Y') : '',
                'establishment' => $local,
                'content' => $contents,
                'user' => 'usuarioTest',
            ];

            // Generar un archivo Excel
            return Excel::download(new ReportInvoiceExport($data), 'invoices.xlsx');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function reportAdministrative(Request $request)
    {
        return 'reportAdministrative';
    }

    public function reportSale(Request $request)
    {

        try {
            $startDate = $request->input('startDate');
            $endDate = $request->input('endDate');
            $local = $request->input('local');

            $startDate = \DateTime::createFromFormat('d-m-Y', $startDate);
            $endDate = \DateTime::createFromFormat('d-m-Y', $endDate);

            // Verifica si startDate y endDate están vacíos y asigna null en ese caso
            if (empty($startDate)) {
                $startDate = null;
            }
            if (empty($endDate)) {
                $endDate = null;
            }

            // Consulta SQL corregida
            $contents = DB::select('SELECT * FROM rpt_sales_report(?, ?, ?)', [$local, $startDate, $endDate]);

            //contenido
            $data = [
                'title' => 'Reportes de ventas',
                'date' => date('d/m/Y'),
                'desde' => $startDate ? $startDate->format('d/m/Y') : '',
                'hasta' => $endDate ? $endDate->format('d/m/Y') : '',
                'establishment' => $local,
                'content' => $contents,
                'user' => 'usuarioTest',
            ];

            // Generar un archivo Excel
            return Excel::download(new ReportSaleExport($data), 'invoices.xlsx');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}

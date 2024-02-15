<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Models\Establishment;
use App\Models\Product;
use Carbon\Carbon;


class PDFController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Welcome to test.com',
            'date' => date('m/d/Y')
        ];

        $pdf = PDF::loadView('testPDF', $data);

        return $pdf->download('test.pdf');
    }

    // public function reportDay(Request $request)
    // {
    //     $desde = $request->input('desde');
    //     $hasta = $request->input('hasta');
    //     $local = $request->input('local');
    //     $user = $request->input('user');

    //     $establishment = Establishment::where('code', $local)->first();

    //     $headers = DB::select('EXEC SP_RPT_ACUMULADO_XDIA_PRODUCTO ?, ?, ?', [$desde, $hasta, $local]);

    //     foreach ($headers as $header) {
    //         $header->cdarticulo = trim($header->cdarticulo);
    //         $header->dsarticulo1 = trim($header->dsarticulo1);
    //     }

    //     //contenido
    //     $contents = DB::select('SP_RPT_ACUMULADO_XDIA_LISTA ?, ?, ?', [$desde, $hasta, $local]);
    //     foreach ($contents as $content) {
    //         $content->cdarticulo = rtrim($content->cdarticulo);
    //         $content->dsarticulo1 = rtrim($content->dsarticulo1);
    //     }

    //     //totales
    //     $results = DB::select('SP_RPT_ACUMULADO_XDIA_RESUMEN ?, ?, ?', [$desde, $hasta, $local]);
    //     // dd($results);

    //     //return ['headers' => $headers, 'contents' => $contents, 'results' => $results];
    //     $data = [
    //         'title' => 'Reportes diarios',
    //         'date' => date('d/m/Y'),
    //         'header' => $headers,
    //         'content' => $contents,
    //         'desde' => $desde,
    //         'hasta' => $hasta,
    //         'local' => $local,
    //         'result' => $results,
    //         'user' => $user,
    //         'establishment' => $establishment->description,
    //     ];

    //     $pdf = PDF::loadView('reportpdf.reportDay',  compact('data'));

    //     return $pdf->download('tutsmake.pdf');
    // }

    public function reportAccumulatedDayPdf(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $startDate = \DateTime::createFromFormat('d-m-Y', $startDate);
        $endDate = \DateTime::createFromFormat('d-m-Y', $endDate);

        $sales = DB::select('SELECT * FROM report_accumulated_day_05(:start_date, :end_date)', [
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
        ]);

        $productNames = [
            "84 OCT(produc)",
        ];

        $data = [
            'title' => 'Reportes acumulado diario',
            'date' => date('d/m/Y'),
            'products_name' => $productNames,
            'sales' => $sales,
            'desde' => $startDate->format('d/m/Y'),
            'hasta' => $endDate->format('d/m/Y'),
            'establishment' => 'falaser',
            'user' => 'usuarioTest',
        ];

        $pdf = PDF::loadView('reportpdf.report_day_sale',  compact('data'));

        return $pdf->download('reporte-acumulado-diario-' . Carbon::now()->format('d-m-Y') . '-' . Carbon::now()->format('His') . '.pdf');
    }

    public function reportSale(Request $request)
    {
        return 'reportSale';
    }

    public function reportSaleDay()
    {
        // Llamada a la función report_accumulated_day
        $sales = DB::select('SELECT * FROM report_accumulated_day()');


        // Buscar los nombres de los productos en la base de datos
        $productNames = Product::all()->pluck('name')->toArray();

        //dd('productNames', $productNames);

        // Agrupar las ventas por fecha

        // Definir la data adicional

        $data = [
            'title' => 'Reportes diarios',
            'date' => date('d/m/Y'),
            'products_name' => $productNames,
            'sales' => $sales,
            'establishment' => 'falaser',
        ];

        $pdf = PDF::loadView('reportpdf.report_day_sale',  compact('data'));

        return $pdf->download('tutsmake.pdf');
    }

    public function reportInvoice(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $startDate = \DateTime::createFromFormat('d-m-Y', $startDate);
        $endDate = \DateTime::createFromFormat('d-m-Y', $endDate);

        $sales = DB::select('SELECT * FROM report_accumulated_day_05(:start_date, :end_date)', [
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $endDate->format('Y-m-d'),
        ]);

        $productNames = [
            "84 OCT(produc)",
        ];

        $data = [
            'title' => 'Reporte de facturas',
            'date' => date('d/m/Y'),
            'products_name' => $productNames,
            'sales' => $sales,
            'desde' => $startDate->format('d/m/Y'),
            'hasta' => $endDate->format('d/m/Y'),
            'establishment' => 'falaser',
            'user' => 'usuarioTest',
        ];

        $pdf = PDF::loadView('reportpdf.report_invoice',  compact('data'));

        return $pdf->download('reporte-acumulado-diario-' . Carbon::now()->format('d-m-Y') . '-' . Carbon::now()->format('His') . '.pdf');
    }
}

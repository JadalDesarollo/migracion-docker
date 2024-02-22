<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Models\Establishment;
use App\Models\Product;
use Carbon\Carbon;
use Svg\Tag\Rect;

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
        $pdf = PDF::loadView('reportpdf.report_sale');

        return $pdf->download('reporte-acumulado-diario-' . Carbon::now()->format('d-m-Y') . '-' . Carbon::now()->format('His') . '.pdf');
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
            'title' => 'Reporte de Facturas',
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

    public function reportAdministrative(Request $request)
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
            'title' => 'Reporte administrativo',
            'date' => date('d/m/Y'),
            'products_name' => $productNames,
            'sales' => $sales,
            'desde' => $startDate->format('d/m/Y'),
            'hasta' => $endDate->format('d/m/Y'),
            'establishment' => 'falaser',
            'user' => 'usuarioTest',
        ];

        $pdf = PDF::loadView('reportpdf.report_administrative',  compact('data'));

        return $pdf->download('reporte-administrativo-' . Carbon::now()->format('d-m-Y') . '-' . Carbon::now()->format('His') . '.pdf');
    }

    public function reportStatistical(Request $request)
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
            'title' => 'Reporte administrativo',
            'date' => date('d/m/Y'),
            'products_name' => $productNames,
            'sales' => $sales,
            'desde' => $startDate->format('d/m/Y'),
            'hasta' => $endDate->format('d/m/Y'),
            'establishment' => 'falaser',
            'user' => 'usuarioTest',
        ];

        $pdf = PDF::loadView('reportpdf.report_statistical',  compact('data'));

        return $pdf->download('reporte-statistical-' . Carbon::now()->format('d-m-Y') . '-' . Carbon::now()->format('His') . '.pdf');
    }

    public function reportControlEffective(Request $request)
    {
        $pdf = PDF::loadView('reportpdf.report_effective_control');
        return $pdf->download('reporte-effective-control-' . Carbon::now()->format('d-m-Y') . '-' . Carbon::now()->format('His') . '.pdf');
    }

    public function reportBank()
    {
        $pdf = PDF::loadView('reportpdf.report_bank');

        return $pdf->download('reporte-bank-' . Carbon::now()->format('d-m-Y') . '-' . Carbon::now()->format('His') . '.pdf');
    }

    public function reportPrettyCash()
    {
        $pdf = PDF::loadView('reportpdf.report_pretty_cash');

        return $pdf->download('reporte-pretty-cash-' . Carbon::now()->format('d-m-Y') . '-' . Carbon::now()->format('His') . '.pdf');
    }

    public function reportCollection()
    {
        $pdf = PDF::loadView('reportpdf.report_collection');

        return $pdf->download('reporte-collection-' . Carbon::now()->format('d-m-Y') . '-' . Carbon::now()->format('His') . '.pdf');
    }

    public function reportProfitability()
    {

        $pdf = PDF::loadView('reportpdf.report_profitability');

        return $pdf->download('reporte-profitability-' . Carbon::now()->format('d-m-Y') . '-' . Carbon::now()->format('His') . '.pdf');
    }

    public function reportSaleNote()
    {
        $pdf = PDF::loadView('reportpdf.report_sale_note');

        return $pdf->download('reporte-sale-note' . Carbon::now()->format('d-m-Y') . '-' . Carbon::now()->format('His') . '.pdf');
    }
}

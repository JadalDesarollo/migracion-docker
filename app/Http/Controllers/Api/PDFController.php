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

    public function reportAccumulatedDayTable(Request $request)
    {
        // Obtener las fechas de inicio y fin del request
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Convertir las fechas de texto a objetos DateTime
        $startDate = \DateTime::createFromFormat('d-m-Y', $startDate);
        $endDate = \DateTime::createFromFormat('d-m-Y', $endDate);

        // Ejecutar la consulta SQL utilizando los objetos DateTime
        $result = DB::select('SELECT * FROM report_accumulated_day_05(:start_date, :end_date)', [
            'start_date' => $startDate->format('Y-m-d'), // Usar el formato correcto para la consulta SQL
            'end_date' => $endDate->format('Y-m-d'),
        ]);

        // Hacer lo que necesites con el resultado, como imprimirlo o pasarlo a una vista
        return $result;
    }

    public function reportAccumulatedDayPdf(Request $request)
    {
        // Obtener las fechas de inicio y fin del request
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Convertir las fechas de texto a objetos DateTime
        $startDate = \DateTime::createFromFormat('d-m-Y', $startDate);
        $endDate = \DateTime::createFromFormat('d-m-Y', $endDate);

        // Ejecutar la consulta SQL utilizando los objetos DateTime
        $sales = DB::select('SELECT * FROM report_accumulated_day_05(:start_date, :end_date)', [
            'start_date' => $startDate->format('Y-m-d'), // Usar el formato correcto para la consulta SQL
            'end_date' => $endDate->format('Y-m-d'),
        ]);

        // Definir los nombres de los productos
        $productNames = [
            "84 OCT(produc)",
        ];

        // Hacer lo que necesites con el resultado, como imprimirlo o pasarlo a una vista
        $data = [
            'title' => 'Reportes diarios',
            'date' => date('d/m/Y'),
            'products_name' => $productNames,
            'sales' => $sales,
            'establishment' => 'falaser',
        ];

        // Cargar la vista del PDF y pasar los datos
        $pdf = PDF::loadView('reportpdf.report_day_sale',  compact('data'));

        // Descargar el PDF
        return $pdf->download('tutsmake.pdf');
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
}

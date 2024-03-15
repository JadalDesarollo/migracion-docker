<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
use Illuminate\Support\Facades\DB;
use App\Models\Establishment;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Tenant;

class TableController extends Controller
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
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $local = $request->input('local');
        $company = $request->input('company');

        $tenant = Tenant::whereJsonContains('data->company', $company)->first();

        if ($tenant) {
            $startDate = \DateTime::createFromFormat('d-m-Y', $startDate);
            $endDate = \DateTime::createFromFormat('d-m-Y', $endDate);

            config(['database.connections.pgsql.database' => $tenant->tenancy_db_name]);
            DB::reconnect('pgsql');

            $result = DB::select('SELECT * FROM rpt_list_sales_accumulate_by_day(?, ?, ?)', [$startDate, $endDate, $local]);

            config(['database.connections.pgsql.database' => env('DB_DATABASE')]);
            DB::reconnect('pgsql');

            return $result;
        } else {
            return response()->json(['message' => 'No se encontró el inquilino con la empresa proporcionada.'], 404);
        }
    }

    public function reportSale(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $local = $request->input('local');
        $company = $request->input('company');

        $tenant = Tenant::whereJsonContains('data->company', $company)->first();

        if ($tenant) {

            $startDate = \DateTime::createFromFormat('d-m-Y', $startDate);
            $endDate = \DateTime::createFromFormat('d-m-Y', $endDate);

            config(['database.connections.pgsql.database' => $tenant->tenancy_db_name]);
            DB::reconnect('pgsql');

            $result = DB::select('SELECT * FROM rpt_sales_report(?, ?, ?)', [$local, $startDate, $endDate]);

            config(['database.connections.pgsql.database' => env('DB_DATABASE')]);
            DB::reconnect('pgsql');

            return $result;
        } else {
            return response()->json(['message' => 'No se encontró el inquilino con la empresa proporcionada.'], 404);
        }
    }

    public function reportBank()
    {
        $result = DB::select('SELECT * FROM report_bank()');

        return $result;
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
        $company = $request->input('company');

        $tenant = Tenant::whereJsonContains('data->company', $company)->first();

        if ($tenant) {
            $startDate = \DateTime::createFromFormat('d-m-Y', $startDate);
            $endDate = \DateTime::createFromFormat('d-m-Y', $endDate);

            $clientName = null;
            $documenNumber = null;
            $situation = null;

            config(['database.connections.pgsql.database' => $tenant->tenancy_db_name]);
            DB::reconnect('pgsql');

            $result = DB::select('SELECT * FROM rtp_document_report(?, ?, ?, ?, ?)', [$clientName, $documenNumber, $startDate, $endDate, $situation]);

            config(['database.connections.pgsql.database' => env('DB_DATABASE')]);
            DB::reconnect('pgsql');

            return $result;
        } else {
            return response()->json(['message' => 'No se encontró el inquilino con la empresa proporcionada.'], 404);
        }
    }

    public function reportSaleNote(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $company = $request->input('company');

        $tenant = Tenant::whereJsonContains('data->company', $company)->first();

        if ($tenant) {

            $startDate = \DateTime::createFromFormat('d-m-Y', $startDate);
            $endDate = \DateTime::createFromFormat('d-m-Y', $endDate);

            $clientId = null;

            config(['database.connections.pgsql.database' => $tenant->tenancy_db_name]);
            DB::reconnect('pgsql');

            $result = DB::select('SELECT * FROM list_detail_order_sale(?, ?, ?)', [$startDate, $endDate, $clientId]);

            config(['database.connections.pgsql.database' => env('DB_DATABASE')]);
            DB::reconnect('pgsql');

            return $result;
        } else {
            return response()->json(['message' => 'No se encontró el inquilino con la empresa proporcionada.'], 404);
        }
    }
}

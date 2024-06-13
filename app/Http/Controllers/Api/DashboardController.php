<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard(Request $request)
    {
        $company = $request->input('company');

        $tenant = Tenant::whereJsonContains('data->company', $company)->first();
        if ($tenant) {

            config(['database.connections.pgsql.database' => $tenant->tenancy_db_name]);
            DB::reconnect('pgsql');

            $clientCount = DB::select('SELECT COUNT(*) as count FROM list_client_order_sale()');
            $salesReportCount = DB::select('SELECT COUNT(*) as count FROM rpt_sales_report()');
            $documentReportCount = DB::select('SELECT COUNT(*) as count FROM rtp_document_report()');
            $salesAccumulateCount = DB::select('SELECT COUNT(*) as count FROM rpt_list_sales_accumulate_by_day()');
            $detailOrderSaleCount = DB::select('SELECT COUNT(*) as count FROM list_detail_order_sale()');

            config(['database.connections.pgsql.database' => env('DB_DATABASE')]);
            DB::reconnect('pgsql');

            $result = [
                'client_count' => $clientCount[0]->count ?? 0,
                'sales_report_count' => $salesReportCount[0]->count ?? 0,
                'document_report_count' => $documentReportCount[0]->count ?? 0,
                'sales_accumulate_count' => $salesAccumulateCount[0]->count ?? 0,
                'detail_order_sale_count' => $detailOrderSaleCount[0]->count ?? 0,
            ];

            return response()->json($result);
        } else {
            return response()->json(['message' => 'No se encontró el inquilino con la empresa proporcionada.'], 404);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

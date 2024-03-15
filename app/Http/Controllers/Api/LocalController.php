<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Tenant;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $company = $request->input('company');

        $tenant = Tenant::whereJsonContains('data->company', $company)->first();

        if ($tenant) {

            config(['database.connections.pgsql.database' => $tenant->tenancy_db_name]);
            DB::reconnect('pgsql');

            $result = DB::select('SELECT * FROM local');

            config(['database.connections.pgsql.database' => env('DB_DATABASE')]);
            DB::reconnect('pgsql');

            return $result;
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

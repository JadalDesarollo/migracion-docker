<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenant;
use App\Http\Requests\TenantRequest;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class TenantController extends Controller
{
    public function store(TenantRequest $request)
    {
        try {
            $tenant = Tenant::create($request->validated());

            $tenant->createDomain(['domain' => $request->domain]);

            //return redirect(tenant_route($tenant->domains->first()->domain, 'tenant.login'));
            return response()->json($tenant);
        } catch (\Exception $e) {
            // Imprime o registra el error para debuggear
            return ($e->getMessage());
        }
    }
}

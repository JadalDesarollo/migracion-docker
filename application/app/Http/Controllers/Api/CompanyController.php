<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Company;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Obtén todas las empresas
            $companies = Company::all();

            // Verifica si hay empresas
            if ($companies->isEmpty()) {
                return sendError('No companies found.', [], 404);
            }

            // Retorna las empresas
            return sendResponse('Companies retrieved successfully!', $companies);
        } catch (Exception $e) {
            return sendError($e->getMessage(), $e->getCode());
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

        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users,name',
            'number'=> 'required|unique:companies,number',
            'identity_document_type_id' => 'required',
            'soap_send_id' => 'required',
            'soap_type_id' => 'required',
        ]);

        if ($validator->fails()) return sendError('Validation Error.', $validator->errors(), 422);

        try {
            $permission = Company::create([
                'name' => $request->name,
                'number' => $request->number,
                'identity_document_type_id' => $request->identity_document_type_id,
                'soap_send_id' => $request->soap_send_id,
                'soap_type_id' => $request->soap_send_id,
            ]);
            return sendResponse('Permission create success!', $permission);
        } catch (Exception $e) {
            return sendError($e->getMessage(), $e->getCode());
        }

        Company::create($request->only('name'));

        return sendResponse('Rol create success!', $request);
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

    public function getCompaniesForCurrentUser()
    {
        try {
            // Obtener el usuario autenticado
            $user = Auth::user();

            // Verificar si el usuario tiene empresas asociadas
            $companies = $user->companies;

            if ($companies->isEmpty()) {
                return sendError('User has no associated companies.', [], 404);
            }

            return sendResponse('Companies retrieved successfully!', $companies);
        } catch (Exception $e) {
            return sendError($e->getMessage(), $e->getCode());
        }
    }
}

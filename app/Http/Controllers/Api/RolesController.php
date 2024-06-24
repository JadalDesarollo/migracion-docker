<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Validation\ValidationException;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return sendResponse('Success', $roles);
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
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        if ($validator->fails()) {
            return sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $role = Role::create(['name' => $request->get('name')]);
            $role->syncPermissions($request->get('permissions'));
            return sendResponse('Rol create success!', $role);
        } catch (\Exception $e) {
            return sendError($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rol = Role::with('permissions')->findOrFail($id);

        $response = [
            'rol' => [
                'id' => $rol->id,
                'name' => $rol->name,
                'guard_name' => $rol->guard_name,
                'created_at' => $rol->created_at,
                'updated_at' => $rol->updated_at,
            ],
            'permissions' => $rol->permissions,
        ];

        return response()->json([
            'success' => true,
            'data' => 'Success',
            'message' => $response,
        ]);
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
        try {
            $role = Role::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:roles,name,' . $role->id,
                'permissions' => 'required|array',
            ]);

            if ($validator->fails()) {
                throw new ValidationException($validator);
            }

            $role->update([
                'name' => $request->input('name'),
                'permissions' => $request->input('permissions'),
            ]);

            if ($request->has('permissions')) {
                $permissions = $request->input('permissions');
                $role->syncPermissions($permissions);
            }

            return sendResponse('Rol update success!', $role);
        } catch (ValidationException $e) {
            return sendError('Validation Error.', $e->errors(), 422);
        } catch (Exception $e) {
            return sendError($e->getMessage(), $e->getCode());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::find($id);

        if (!$role) {
            return response()->json(['success' => false, 'message' => 'Role not found.'], 404);
        }

        $role->delete();

        return response()->json(['success' => true, 'message' => 'Role deleted successfully.']);
    }
}

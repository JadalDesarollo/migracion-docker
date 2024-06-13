<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\CompanyUserRol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Exception;
use App\Helpers\Helpers;

class AuthController extends Controller
{
    /**
     * User login API method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return sendError('Validation Error.', $validator->errors(), 422);
        }

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Obtener la empresa asociada al usuario
            $companies = $user->companies;

            $response = [
                'id' => $user->id,
                'name' => $user->name,
                'token' => $user->createToken('accessToken')->accessToken,
                'companies' => []
            ];

            if ($companies->isNotEmpty()) {
                $response['companies'] = $companies->map(function ($company) use ($user) {
                    $companyUserRoles = CompanyUserRol::where('user_id', $user->id)
                        ->get();
                    $originalAttributesArray = $companyUserRoles->map->getOriginal()->toArray();

                    $rolesData = [];

                    if (!empty($originalAttributesArray)) {
                        foreach ($originalAttributesArray as $companyUserRol) {

                            if ($companyUserRol['company_id'] == $company->id) {
                                $rol = Role::find($companyUserRol['rol_id']);
                                $rolName = $rol ? $rol->name : null;

                                $permissions = [];
                                if ($rol) {
                                    $permissions = $rol->permissions->pluck('name')->toArray();
                                }

                                $rolesData[] = [
                                    'id' => $companyUserRol['id'],
                                    'user_id' => $companyUserRol['user_id'],
                                    'company_id' => $companyUserRol['company_id'],
                                    'rol_id' => $companyUserRol['rol_id'],
                                    'rol_name' => $rolName,
                                    'permissions' => $permissions,
                                ];
                            }
                        }
                    }

                    return [
                        'id' => $company->id,
                        'name' => $company->name,
                        'trade_name' => $company->trade_name,
                        'commerce_code' => $company->commerce_code,
                        'roles' => $rolesData,
                    ];
                })->toArray();
            }

            return sendResponse($response, 'You are successfully logged in.');
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }


    /**
     * User registration API method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
            'rolesAndCompanies' => 'required|array',
            'rolesAndCompanies.*.role' => 'required',
            'rolesAndCompanies.*.company' => 'required',
        ]);

        if ($validator->fails()) {
            return sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $user = User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $userRoles = [];
            foreach ($request->rolesAndCompanies as $item) {
                $role = Role::find($item['role']);
                $company = Company::find($item['company']);

                if ($role && $company) {
                    $userRoles[] = [
                        'user_id'    => $user->id,
                        'company_id' => $company->id,
                        'rol_id'     => $role->id,
                    ];

                    $user->assignRole($role);
                }
            }

            // Assuming you have a pivot table named 'company_user_rols'
            CompanyUserRol::insert($userRoles);

            $success['name'] = $user->name;
            $message = 'Yay! A user has been successfully created.';
            $success['token'] = $user->createToken('accessToken')->accessToken;
        } catch (Exception $e) {
            $success['token'] = null;
            $message = 'Oops! Unable to create a new user. ' . $e->getMessage();
        }

        return sendResponse($success, $message);
    }


    /**
     * This method returns authenticated user details
     */
    public function me()
    {
        if (auth()->user()) {
            return response()->json(['authenticated-user' => auth()->user()], 200);
        } else {
            return sendError('Unauthorised', ['error' => 'Unauthorised'], 401);
        }
    }

    public function logout(Request $request)
    {
        auth()->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out.']);
    }

    public function index()
    {
        try {
            $users = User::with('roles')->get();
            return sendResponse('Success', $users);
        } catch (Exception $e) {
            return sendError($e->getMessage(), $e->getCode());
        }
    }

    public function show($id)
    {
        $user = User::with(['roles.permissions', 'companyUserRoles', 'companies'])->find($id);

        if ($user) {
            $companiesData = $user->companies->map(function ($company) use ($user) {
                $companyUserRoles = $user->companyUserRoles->where('company_id', $company->id);

                $rolesData = $companyUserRoles->map(function ($companyUserRol) {
                    $rol = Role::find($companyUserRol->rol_id);
                    $rolName = $rol ? $rol->name : null;

                    $permissions = [];
                    if ($rol) {
                        $permissions = $rol->permissions->pluck('name')->toArray();
                    }

                    return [
                        'id' => $companyUserRol->id,
                        'user_id' => $companyUserRol->user_id,
                        'company_id' => $companyUserRol->company_id,
                        'rol_id' => $companyUserRol->rol_id,
                        'rol_name' => $rolName,
                        'permissions' => $permissions,
                    ];
                });

                return [
                    'id' => $company->id,
                    'name' => $company->name,
                    'trade_name' => $company->trade_name,
                    'commerce_code' => $company->commerce_code,
                    'roles' => $rolesData->values()->toArray(), // Utiliza values()->toArray()
                ];
            });

            $userData = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'companies' => $companiesData->toArray(),
            ];

            return sendResponse('Success', $userData);
        } else {
            return sendError('Data not found');
        }
    }



    public function refreshToken(Request $request)
    {
        $user = Auth::user();

        $user->token()->revoke();

        $newToken = $user->createToken('accessToken')->accessToken;

        $success['id']  = $user->id;
        $success['name']  = $user->name;
        $success['email']  = $user->email;
        $success['token'] = $newToken;
        $success['rol'] = $user->getRoleNames()->toArray();
        $success['permissions'] = $user->getPermissionsViaRoles()->pluck('name')->toArray();

        return sendResponse($success, 'Token refreshed successfully.');
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            if ($user) {
                $user->delete();
                return sendResponse('User deleted successfully.', 'User deleted successfully.');
            } else {
                return sendError('User not found.');
            }
        } catch (Exception $e) {
            return sendError($e->getMessage(), $e->getCode());
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $id,
            'rolesAndCompanies' => 'required|array',
            'rolesAndCompanies.*.role' => 'required',
            'rolesAndCompanies.*.company' => 'required',
        ]);

        if ($validator->fails()) {
            return sendError('Validation Error.', $validator->errors(), 422);
        }

        try {
            $user = User::find($id);

            if (!$user) {
                return sendError('User not found.');
            }

            // Update user details
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            // Remove existing roles and companies
            CompanyUserRol::where('user_id', $user->id)->delete();

            $userRoles = [];
            foreach ($request->rolesAndCompanies as $item) {
                $role = Role::find($item['role']);
                $company = Company::find($item['company']);

                if ($role && $company) {
                    $userRoles[] = [
                        'user_id'    => $user->id,
                        'company_id' => $company->id,
                        'rol_id'     => $role->id,
                    ];

                    $user->assignRole($role);
                }
            }

            // Assuming you have a pivot table named 'company_user_rols'
            CompanyUserRol::insert($userRoles);

            $success['name'] = $user->name;
            $message = 'User details have been successfully updated.';
        } catch (Exception $e) {
            $success['name'] = null;
            $message = 'Oops! Unable to update user details. ' . $e->getMessage();
        }

        return sendResponse($success, $message);
    }

}

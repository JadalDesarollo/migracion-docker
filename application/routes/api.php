<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\PermissionsController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them
| will be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return ('API auth laravel!');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
//Route::get('/me', [AuthController::class,'me']);
//add this middleware to ensure that every request is authenticated

Route::get('/login', function(){
    // return sendError('Unauthorised', '', 401);
    return response()->json(['message' => 'Unauthorised'], 401);
})->name('login');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/me', [AuthController::class, 'me'])->name('me');

    //Route::get('/users', [AuthController::class, 'index'])->name('index');
    Route::resource('/blog', BlogController::class)->except('create','edit');
    Route::post('/refresh/token', [AuthController::class, 'refreshToken']);

    Route::get('/companies_users', [CompanyController::class, 'getCompaniesForCurrentUser']);
});

//usuarios
Route::get('/users/{id}', [AuthController::class, 'show'])->name('show');
Route::get('/users', [AuthController::class, 'index'])->name('index');
Route::delete('/users/{id}', [AuthController::class, 'destroy'])->name('destroy');
Route::put('/users/{id}', [AuthController::class, 'update'])->name('update');

//roles permisos empresas
Route::resource('/roles', RolesController::class);
Route::resource('/permissions', PermissionsController::class);
Route::resource('/companies', CompanyController::class);
//Route::get('/companies-users', [CompanyController::class, 'getCompaniesForCurrentUser']);



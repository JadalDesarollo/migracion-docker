<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\PermissionsController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\CompanyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TableController;
use App\Http\Controllers\Api\PDFController;
use App\Http\Controllers\Api\ExcelController;
use App\Http\Controllers\Api\LocalController;
use App\Http\Controllers\Api\TenantController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\ClientController;
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
    return ('API laravel!');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
//Route::get('/me', [AuthController::class,'me']);
//add this middleware to ensure that every request is authenticated

Route::get('/login', function () {
    // return sendError('Unauthorised', '', 401);
    return response()->json(['message' => 'Unauthorised'], 401);
})->name('login');

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/me', [AuthController::class, 'me'])->name('me');

    //Route::get('/users', [AuthController::class, 'index'])->name('index');
    Route::resource('/blog', BlogController::class)->except('create', 'edit');
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

Route::post('/local', [LocalController::class, 'index']);
Route::post('/clients', [ClientController::class, 'list']);

Route::prefix('report')->group(function () {

    //reportes example
    Route::get('create-pdf-file', [PDFController::class, 'index']);
    Route::get('create-excel-file', [ExcelController::class, 'index']);

    //reportes table
    Route::prefix('table')->group(function () {
        Route::get('invoice', [TableController::class, 'reportInvoice']);
        Route::post('accumulated/day', [TableController::class, 'reportAccumulatedDayTable']);
        Route::post('sale', [TableController::class, 'reportSale']);
        Route::get('bank', [TableController::class, 'reportBank']);
        Route::post('invoice', [TableController::class, 'reportInvoice']);
        Route::post('sale/note', [TableController::class, 'reportSaleNote']);
    });

    //reportes pdf
    Route::prefix('pdf')->group(function () {
        Route::post('invoice', [PDFController::class, 'reportInvoice']);
        Route::post('accumulated/day', [PDFController::class, 'reportAccumulatedDayPdf']);
        Route::post('sale', [PDFController::class, 'reportSale']);
        Route::post('sale/day', [PDFController::class, 'reportSaleDay']);
        Route::get('bank', [PDFController::class, 'reportBank']);
        Route::post('administrative', [PDFController::class, 'reportAdministrative']);
        Route::post('statistical', [PDFController::class, 'reportStatistical']);
        Route::post('effective/control', [PDFController::class, 'reportControlEffective']);
        Route::post('bank', [PDFController::class, 'reportBank']);
        Route::post('pretty/cash', [PDFController::class, 'reportPrettyCash']);
        Route::post('collection', [PDFController::class, 'reportCollection']);
        Route::post('profitability', [PDFController::class, 'reportProfitability']);
        Route::post('sale/note', [PDFController::class, 'reportSaleNote']);
    });

    //reportes excel
    Route::prefix('excel')->group(function () {
        Route::post('invoice', [ExcelController::class, 'reportInvoice']);
        Route::post('day', [ExcelController::class, 'reportDay']);
        Route::post('accumulated/day', [ExcelController::class, 'reportAccumulatedDayExcel']);
        Route::post('sale', [ExcelController::class, 'reportSale']);
        Route::post('administrative', [ExcelController::class, 'reportAdministrative']);
        Route::post('statistical', [ExcelController::class, 'reportStatistical']);
        Route::post('sale/note', [ExcelController::class, 'reportSaleNote']);
    });

    Route::prefix('dashboard')->group(function () {
        Route::post('dashboard', [DashboardController::class, 'dashboard']);
    });

    //tenant
    Route::post('/register/tenant', [TenantController::class, 'store'])->name('store');
});
//reportes table
//Route::post('report/accumulated/day/table', [TableController::class, 'reportAccumulatedDayTable']);
// Route::post('report/sale/table', [TableController::class, 'reportSale']);
// Route::get('report/bank/table', [TableController::class, 'reportBank']);
// Route::get('report/invoice/table', [TableController::class, 'reportBank']);

// //reportes pdf
// Route::post('report/accumulated/day/pdf', [PDFController::class, 'reportAccumulatedDayPdf']);
// Route::get('report/sale/pdf/day', [PDFController::class, 'reportSaleDay']);
// Route::post('report/invoice/pdf', [PDFController::class, 'reportInvoice']);

// //reportes excel
// Route::post('report/excel/day', [ExcelController::class, 'reportDay']);
// Route::post('report/accumulated/day/excel', [ExcelController::class, 'reportAccumulatedDayExcel']);
// Route::post('report/invoice/excel', [ExcelController::class, 'reportAccumulatedDayExcel']);

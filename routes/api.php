<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    //obtain all active employees
    Route::get('/employees', [EmployeeController::class, 'index']);

    //add new employee
    Route::post('/employee', [EmployeeController::class, 'store']);

    //update employee
    Route::put('/employee/{folio}', [EmployeeController::class, 'update']);

    //store a contract
    Route::post('/contract', [ContractController::class, 'store']);

    //delete a contract
    Route::delete('/contract/{employee_id}', [ContractController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});

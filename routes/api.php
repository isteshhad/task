<?php

use App\Http\Controllers\API\EmployeeController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('register', [App\Http\Controllers\API\RegisterController::class, 'register']);
Route::post('login', [App\Http\Controllers\API\RegisterController::class, 'login']);

Route::middleware('auth:api')->group( function () {
//    Route::resource('employees', 'API\EmployeeController');

    Route::get('employees', [App\Http\Controllers\API\EmployeeController::class, 'index']);
    Route::post('employees/store',  [App\Http\Controllers\API\EmployeeController::class, 'store']);
    Route::get('employees/{employee}', [App\Http\Controllers\API\EmployeeController::class, 'show']);
    Route::put('employees/update/{employee}', [App\Http\Controllers\API\EmployeeController::class, 'update']);
    Route::delete('employees/destroy/{employee}', [App\Http\Controllers\API\EmployeeController::class, 'destroy']);
});





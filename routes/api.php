<?php

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();


// });


Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

    Route::get('/joblevel', [\App\Http\Controllers\Api\JoblevelController::class, 'index']);
    Route::get('/joblevel/option-data', [\App\Http\Controllers\Api\JoblevelController::class, 'DataOption']);
    Route::delete('/joblevel/delete', [\App\Http\Controllers\Api\JoblevelController::class, 'multidel']);
    Route::post('/joblevel/save', [\App\Http\Controllers\Api\JoblevelController::class, 'SaveData']);
    Route::get('/joblevel/{id}', [\App\Http\Controllers\Api\JoblevelController::class, 'ShowByid']);
    Route::put('/joblevel/update/{id}', [\App\Http\Controllers\Api\JoblevelController::class, 'updateData']);


    Route::get('/jobgrade', [\App\Http\Controllers\Api\JobgradeController::class, 'index']);
    Route::get('/jobgrade/option-data', [\App\Http\Controllers\Api\JobgradeController::class, 'DataOption']);
    Route::delete('/jobgrade/delete', [\App\Http\Controllers\Api\JobgradeController::class, 'multidel']);
    Route::post('/jobgrade/save', [\App\Http\Controllers\Api\JobgradeController::class, 'SaveData']);
    Route::put('/jobgrade/update/{id}', [\App\Http\Controllers\Api\JobgradeController::class, 'updateData']);
    Route::get('/jobgrade/{id}', [\App\Http\Controllers\Api\JobgradeController::class, 'ShowByid']);

    Route::get('/jobtitle', [\App\Http\Controllers\Api\JobtitleController::class, 'index']);
    Route::get('/jobtitle/option-data', [\App\Http\Controllers\Api\JobtitleController::class, 'DataOption']);
    Route::get('/jobtitle/{id}', [\App\Http\Controllers\Api\JobtitleController::class, 'ShowByid']);
    Route::post('/jobtitle/save', [\App\Http\Controllers\Api\JobtitleController::class, 'SaveData']);
    Route::put('/jobtitle/update/{id}', [\App\Http\Controllers\Api\JobtitleController::class, 'updateData']);
    Route::delete('/jobtitle/delete/{id}', [\App\Http\Controllers\Api\JobtitleController::class, 'deleteData']);


    Route::get('/client', [\App\Http\Controllers\Api\ClientController::class, 'index']);
    Route::post('/client/register', [\App\Http\Controllers\Api\ClientController::class, 'register']);
    Route::post('/client/login', [\App\Http\Controllers\Api\ClientController::class, 'login']);
    Route::get('/client/{id}', [\App\Http\Controllers\Api\ClientController::class, 'ShowByid']);
    Route::put('/client/update/{id}', [\App\Http\Controllers\Api\ClientController::class, 'updateData']);
    Route::delete('/client/delete/{id}', [\App\Http\Controllers\Api\ClientController::class, 'deleteData']);
    Route::delete('/client/delete', [\App\Http\Controllers\Api\ClientController::class, 'multidel']);


    Route::get('/religi', [\App\Http\Controllers\Api\ReligiController::class, 'index']);
    Route::post('/religi/save', [\App\Http\Controllers\Api\ReligiController::class, 'SaveData']);
    Route::get('/religi/{id}', [\App\Http\Controllers\Api\ReligiController::class, 'ShowByid']);
    Route::put('/religi/update/{id}', [\App\Http\Controllers\Api\ReligiController::class, 'updateData']);
    Route::delete('/religi/delete/{id}', [\App\Http\Controllers\Api\ReligiController::class, 'deleteData']);
    Route::delete('/religi/delete', [\App\Http\Controllers\Api\ReligiController::class, 'multidel']);

    Route::get('/marriage-status', [\App\Http\Controllers\Api\MarriagestatusController::class, 'index']);
    Route::post('/marriage-status/save', [\App\Http\Controllers\Api\MarriagestatusController::class, 'SaveData']);
    Route::get('/marriage-status/{id}', [\App\Http\Controllers\Api\MarriagestatusController::class, 'ShowByid']);
    Route::put('/marriage-status/update/{id}', [\App\Http\Controllers\Api\MarriagestatusController::class, 'updateData']);
    Route::delete('/marriage-status/delete/{id}', [\App\Http\Controllers\Api\MarriagestatusController::class, 'deleteData']);
    Route::delete('/marriage-status/delete', [\App\Http\Controllers\Api\MarriagestatusController::class, 'multidel']);

    Route::get('/tax-status', [\App\Http\Controllers\Api\TaxstatusController::class, 'index']);
    Route::get('/tax-status/option-data', [\App\Http\Controllers\Api\TaxstatusController::class, 'GetData']);
    Route::post('/tax-status/save', [\App\Http\Controllers\Api\TaxstatusController::class, 'SaveData']);
    Route::get('/tax-status/{id}', [\App\Http\Controllers\Api\TaxstatusController::class, 'ShowByid']);
    Route::put('/tax-status/update/{id}', [\App\Http\Controllers\Api\TaxstatusController::class, 'updateData']);
    Route::delete('/tax-status/delete/{id}', [\App\Http\Controllers\Api\TaxstatusController::class, 'deleteData']);
    Route::delete('/tax-status/delete', [\App\Http\Controllers\Api\TaxstatusController::class, 'multidel']);

    Route::get('/blood-type', [\App\Http\Controllers\Api\BloodtypeController::class, 'index']);
    Route::post('/blood-type/save', [\App\Http\Controllers\Api\BloodtypeController::class, 'SaveData']);
    Route::get('/blood-type/{id}', [\App\Http\Controllers\Api\BloodtypeController::class, 'ShowByid']);
    Route::put('/blood-type/update/{id}', [\App\Http\Controllers\Api\BloodtypeController::class, 'updateData']);
    Route::delete('/blood-type/delete/{id}', [\App\Http\Controllers\Api\BloodtypeController::class, 'deleteData']);
    Route::delete('/blood-type/delete', [\App\Http\Controllers\Api\BloodtypeController::class, 'multidel']);

    Route::get('/bank', [\App\Http\Controllers\Api\BankController::class, 'index']);
    Route::post('/bank/save', [\App\Http\Controllers\Api\BankController::class, 'SaveData']);
    Route::get('/bank/{id}', [\App\Http\Controllers\Api\BankController::class, 'ShowByid']);
    Route::put('/bank/update/{id}', [\App\Http\Controllers\Api\BankController::class, 'updateData']);
    Route::delete('/bank/delete/{id}', [\App\Http\Controllers\Api\BankController::class, 'deleteData']);
    Route::delete('/bank/delete', [\App\Http\Controllers\Api\BankController::class, 'multidel']);
});


// Route::get('/joblevel/getoption', [\App\Http\Controllers\Api\JoblevelController::class, 'GetsData']);


Route::get('/employee', [\App\Http\Controllers\Api\EmployeeController::class, 'index']);
Route::get('/employee/{id}', [\App\Http\Controllers\Api\EmployeeController::class, 'ShowByid']);
Route::post('/employee/save', [\App\Http\Controllers\Api\EmployeeController::class, 'SaveData']);
Route::put('/employee/update/{id}', [\App\Http\Controllers\Api\EmployeeController::class, 'updateData']);
Route::delete('/employee/delete/{id}', [\App\Http\Controllers\Api\EmployeeController::class, 'deleteData']);
Route::delete('/employee/delete', [\App\Http\Controllers\Api\EmployeeController::class, 'multidel']);






Route::delete('jobgrade/delete/{id}', [\App\Http\Controllers\Api\JobgradeController::class, 'deleteData']);


// Route::delete('/joblevel/delete/{id}', [\App\Http\Controllers\Api\JoblevelController::class, 'deleteData']);





Route::get('/departement', [\App\Http\Controllers\Api\DepartementController::class, 'index']);
Route::get('/departement/{id}', [\App\Http\Controllers\Api\DepartementController::class, 'ShowByid']);
Route::post('/departement/save', [\App\Http\Controllers\Api\DepartementController::class, 'SaveData']);
Route::put('/departement/update/{id}', [\App\Http\Controllers\Api\DepartementController::class, 'updateData']);
Route::delete('/departement/delete/{id}', [\App\Http\Controllers\Api\DepartementController::class, 'deleteData']);
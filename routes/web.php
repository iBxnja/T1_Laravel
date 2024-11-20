<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('T1_Laravel');
});



#---------------------------------------------------------------#
#                  Controlador                                  #
#---------------------------------------------------------------#
Route::prefix('')->group(function () {
    Route::get('/', [TaskController::class, 'index']);
    Route::get('/export-csv', [TaskController::class, 'exportToCsv'])->name('export.csv');

});


#---------------------------------------------------------------#

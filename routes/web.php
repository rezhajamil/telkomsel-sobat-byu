<?php

use App\Http\Controllers\AmbassadorController;
use App\Http\Controllers\EsportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SpecialOfferController;
use App\Http\Controllers\TheStageController;
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

Route::get('/', [HomeController::class, 'index']);
Route::resource('/home', HomeController::class);

Route::resource('/the_stage', TheStageController::class);
Route::resource('/ambassador_digital', AmbassadorController::class);
Route::resource('/special_offer', SpecialOfferController::class);
Route::resource('/esport', EsportController::class);
Route::resource('/peserta', PesertaController::class);

Route::post('/find_school', [HomeController::class, 'find_school']);

require __DIR__ . '/auth.php';

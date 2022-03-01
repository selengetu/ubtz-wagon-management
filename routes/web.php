<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\RepController;
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
    return view('auth.login');
});

//AUTH
//Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');

Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\WagonController::class, 'index'])->name('home');

Route::post('/passw',  [App\Http\Controllers\HomeController::class,'passw'])->name('passw');
Route::get('/wagon/delete/{id}', [App\Http\Controllers\WagonController::class,'delete']);
Route::post('/savewagon',[App\Http\Controllers\WagonController::class,'savewagon'])->name('savewagon');
Route::post('/updatewagon','WagonController@update');
Route::get('/getwagon/{id?}',function($id = 0){
    $dt=DB::table('v_wagons')->where('wag_id','=',$id)->get();
    return $dt;
});

Route::get('/company', [App\Http\Controllers\CompanyController::class, 'index'])->name('company');
Route::get('/company/delete/{id}', [App\Http\Controllers\CompanyController::class,'delete']);
Route::post('/savecompany',[App\Http\Controllers\CompanyController::class,'save'])->name('saveCom');
Route::post('/updatecompany','CompanyController@update');
Route::get('/getcompany/{id?}',function($id = 0){
    $dt=DB::table('company_info')->where('company_id','=',$id)->get();
    return $dt;
});
Route::get('/comwag/{id}', [App\Http\Controllers\WagonController::class,'comwagon']);


Route::get('/type', [App\Http\Controllers\WagonController::class, 'type'])->name('type');

Route::get('/railway', [App\Http\Controllers\WagonController::class, 'railway'])->name('railway');
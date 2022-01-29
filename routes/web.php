<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', function () {
    return view('auth.login');
});
/*Route::get('/empleado', function () {
    return view('empleados.index');
});
Route::get('/empleado/create', [EmpleadoController::class, 'create']);*/

Route::middleware(['auth'])->group(function(){
//para acceder a todas las vistas del controlador
    Route::resource('empleado', EmpleadoController::class);
    //Route::resource('empleado', EmpleadoController::class)->middleware('auth');
});

Auth::routes(['register'=> false, 'password.request' => false, 'password.reset' => false]);



//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

/*Route::group(['middleware' => 'auth'], functtion(){
    Route::get('/', [EmpleadoController::class, 'index'])->name('home')
});*/

Route::middleware(['auth'])->group(function(){
  Route::get('/index', 'EmpleadoController@index');
});
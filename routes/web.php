<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use Illuminate\Support\Facades\Auth; // Agregado

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

// Route::get('/empleado', function () {
//     return view('empleado.index');
// });

// Route::get('/empleado/create', [EmpleadoController::class, 'create']);

// middleware auth no permite entrar a la pagina sin autenticarse
Route::resource('empleado', EmpleadoController::class)->middleware('auth'); // Ahora esta ruta soporta todos los metodos

Auth::routes(['register' => false, 'reset' => false]); // Desactivar el registro y el recordar contraseña

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
});

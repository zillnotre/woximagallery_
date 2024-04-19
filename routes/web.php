<?php

use App\Models\like_foto;
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



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' =>['web','auth']], function(){
    Route::get('/', function () {
        $foto = App\Models\Foto::all(); // Corrected the model name to match the class name
        return view('welcome', ['foto' => $foto]); // Passing the $foto variable to the view
    });


    Route::post('/foto', [App\Http\Controllers\FotoController::class, 'store'])->name('foto.store');
    Route::post('/foto/like', 'App\Http\Controllers\like_fotoController@likefoto')->name('likefoto');


});

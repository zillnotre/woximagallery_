<?php

use App\Models\like_foto;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FotoController;

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



    Route::delete('/foto/{id}', 'App\Http\Controllers\FotoController@delete')->name('foto.delete');
    Route::post('comment/{foto}', 'App\Http\Controllers\Komentar_FotoController@postComment')->name('addComment');

    Route::middleware(['auth'])->group(function () {
        Route::get('/albums', [App\Http\Controllers\AlbumController::class, 'index'])->name('albums.index');
        Route::get('/albums/create', [App\Http\Controllers\AlbumController::class, 'create'])->name('albums.create');
        Route::post('/albums', [App\Http\Controllers\AlbumController::class, 'store'])->name('albums.store');
        Route::get('/albums/{album}', [App\Http\Controllers\AlbumController::class, 'show'])->name('albums.show');
        Route::get('/albums/{album}/edit', [App\Http\Controllers\AlbumController::class, 'edit'])->name('albums.edit');
        Route::put('/albums/{album}', [App\Http\Controllers\AlbumController::class, 'update'])->name('albums.update');
        Route::delete('/albums/{album}', [App\Http\Controllers\AlbumController::class, 'destroy'])->name('albums.destroy');


        Route::get('/welcome', [App\Http\Controllers\AlbumController::class, 'index'])->name('welcome');

        Route::get('/albums/{album}', 'App\Http\Controllers\AlbumController@show')->name('album.show');

    });



    // Route::resource('albums', AlbumController::class);
    // Route::post('/albums', 'AlbumController@store')->name('albums.store');



});

<?php

use Illuminate\Http\Request;

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

header('Access-Control-Allow-Origin:  *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('API')->name('api.')->group( function () {
    Route::prefix('artistas')->group(function () {
        Route::get('/', 'ArtistaController@show')->name('busca_artistas');

        Route::post('/', 'ArtistaController@store')->name('store_artistas');
        Route::put('/', 'ArtistaController@update')->name('update_artistas');

        Route::delete('/', 'ArtistaController@delete')->name('delete_artistas');

    });
});

Route::namespace('API')->name('api.')->group(function () {
    Route::prefix('generos')->group(function () {
        Route::get('/', 'GeneroController@show')->name('busca_genero');

        Route::post('/', 'GeneroController@store')->name('store_genero');
        Route::put('/', 'GeneroController@update')->name('update_genero');

        Route::delete('/', 'GeneroController@delete')->name('delete_genero');
    });
});

Route::namespace('API')->name('api.')->group(function () {
    Route::prefix('cds')->group(function () {
        Route::get('/', 'CompactDiscController@show')->name('busca_cd');

        Route::post('/', 'CompactDiscController@store')->name('store_cd');
        Route::put('/', 'CompactDiscController@update')->name('update_cd');

        Route::delete('/', 'CompactDiscController@delete')->name('delete_cd');
    });
});

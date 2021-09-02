<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group([
    'namespace' => 'App\Http\Controllers',
    'middleware' => 'auth'
], function () {
    Route::get('/message', 'MessageController@index')->name('message.index');
    Route::get('/message/{id}', 'MessageController@show')->name('message.show');
    Route::post('/message', 'MessageController@store')->name('message.store');
    Route::put('/message/{id}', 'MessageController@update')->name('message.update');
    Route::delete('/message/{id}', 'MessageController@destroy')->name('message.destroy');

});

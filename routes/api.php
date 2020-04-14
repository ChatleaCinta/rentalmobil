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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', 'PetugasController@register');
Route::post('login', 'PetugasController@login');
Route::get('/', function(){
    return Auth::user()->level;
})->middleware('jwt.verify');

Route::get('user', 'PetugasController@getAuthenticatedUser')->middleware('jwt.verify');

//penyewa
Route::get('ip/{id}','PenyewaController@index')->middleware('jwt.verify');
Route::post('tp','PenyewaController@store')->middleware('jwt.verify');
Route::put('/upp/{id}','PenyewaController@update')->middleware('jwt.verify');
Route::delete('dp/{id}','PenyewaController@destroy')->middleware('jwt.verify');
Route::get('sp','PenyewaController@tampil')->middleware('jwt.verify');

//mobil
Route::get('im/{id}','MobilController@index')->middleware('jwt.verify');
Route::post('tm','MobilController@store')->middleware('jwt.verify');
Route::put('/upm/{id}','MobilController@update')->middleware('jwt.verify');
Route::delete('dm/{id}','MobilController@destroy')->middleware('jwt.verify');
Route::get('sm','MobilController@tampil')->middleware('jwt.verify');

//jenis mobil
Route::get('ijm/{id}','JenisMobilController@index')->middleware('jwt.verify');
Route::post('tjm','JenisMobilController@store')->middleware('jwt.verify');
Route::put('/ujm/{id}','JenisMobilController@update')->middleware('jwt.verify');
Route::delete('djm/{id}','JenisMobilController@destroy')->middleware('jwt.verify');
Route::get('sjm','JenisMobilController@tampil')->middleware('jwt.verify');



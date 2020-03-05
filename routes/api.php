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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function () {
    return 'Api para candidaturas de emprego, favor efetuar autenticação';
})->name('api.index');

Route::prefix('auth')->namespace('Auth')->group(function () {
    Route::get('me', 'LoginController@me')->name('me');
    Route::post('refresh', 'LoginController@refresh')->name('me');
    Route::post('login', 'LoginController@login')->name('login');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::prefix('admin')->middleware('jwt.auth')->namespace('Admin')->group(function () {
    Route::resource('users', 'UserController');
    Route::resource('jobs', 'JobController');
});


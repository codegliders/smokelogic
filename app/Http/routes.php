<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/index', function () {
    return view('index');
});

Route::group(['middleware' => ['web']], function () {
    Route::get('/',  'CigaretteController@index');

    // Authentication Routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration Routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//cigarette route
Route::get('/cig', 'CigaretteController@index');
Route::post('/cig', 'CigaretteController@store');
Route::delete('/cig/{cig}', 'CigaretteController@destroy');

//bar chart data
Route::get('getpiechartdatalasttwoweeks',  'CigaretteController@getBarChartDataLastTwoWeeks');


}
);

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

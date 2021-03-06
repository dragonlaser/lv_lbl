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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
Route::get('/menu', 'API\ApiController@get_menu');
Route::get('/{id}/content', 'API\ApiController@get_content');
Route::get('/{id}/category', 'API\ApiController@get_category');
// Route::get('/menu', function() {
//     return \Laraspace\Models\FrontMenu::get();
// });

Route::get('/data_contact','Admin\ContactinformationController@list');
Route::resource('/contact','Admin\ContactinformationController');
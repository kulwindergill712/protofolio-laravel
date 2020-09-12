<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/contact', 'ContactController@create');

Route::post('/project/create', 'ProjectController@create');
Route::get('/project/get', 'ProjectController@get');

Route::post('/pic', 'ProjectController@image_path');

Route::post('/social/create', 'SocialLinkController@create');
Route::get('/social/get', 'SocialLinkController@get');

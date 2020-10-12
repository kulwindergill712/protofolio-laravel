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
Route::get('/contact/get', 'ContactController@get');

Route::post('/project/create', 'ProjectController@create');
Route::get('/project/get/{id?}', 'ProjectController@get');

// download
Route::get('/cv', 'ProjectController@download');

Route::post('/pic', 'ProjectController@image_path');

Route::post('/social/create', 'SocialLinkController@create');
Route::get('/social/get', 'SocialLinkController@get');
Route::delete('/social/delete/{id}', 'SocialLinkController@delete');
Route::put('/social/update/{id}', 'SocialLinkController@update');

Route::post('/crousel/create', 'CrouselController@create');
Route::get('/crousel/get', 'CrouselController@get');

Route::post('/sam', 'ProjectController@sam');

Route::post('/user/login', 'UserController@login');

Route::post('/blog/create', 'BlogController@create');
Route::get('/blog/get/{id?}', 'BlogController@get');
Route::delete('/blog/delete/{id}', 'BlogController@delete');
Route::put('/blog/update/{id}', 'BlogController@update');

Route::post('/login/google', 'SocialController@googlelogin');

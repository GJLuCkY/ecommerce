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

Route::get('/v1/creation-and-updating-categories', 'API\DataApiController@postCreationAndUpdatingCategory');

Route::get('/v1/creation-and-updating-products', 'API\DataApiController@postCreationAndUpdatingProducts');

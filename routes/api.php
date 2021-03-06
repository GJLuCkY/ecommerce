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

Route::post('/v1/creation-and-updating-categories', 'API\DataApiController@postCreationAndUpdatingCategory');

Route::post('/v1/creation-and-updating-products', 'API\DataApiController@postCreationAndUpdatingProducts');

Route::post('/v1/get-new-orders', 'API\DataApiController@getNewOrders');

Route::post('/v1/get-new-orders-2', 'API\DataApiController@changeOrder');




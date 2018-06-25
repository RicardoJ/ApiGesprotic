<?php

use Illuminate\Http\Request;
use App\Provider;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/



//Route::get('/showproviders','ProviderController@show');

//Route::apiResource('users','UserController');
Route::apiResource('providers','ProviderController');
Route::apiResource('agreements','AgreementController',['only'=>['index','show']]);
Route::Resource('providers.agreements','ProviderAgreementController',['except'=>['show','create','edit']]);
Route::apiResource('projectteams','ProjectTeamController');
Route::apiResource('resources','ResourceController');
//Route::apiResource('projects','ProjectController');

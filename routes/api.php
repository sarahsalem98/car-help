<?php

use App\Http\Controllers\Api\Client\AddressController;
use App\Http\Controllers\Api\Client\CarController;
use App\Http\Controllers\Api\Provider\ProductController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('client')->group(function(){
    Route::post('register','App\Http\Controllers\Api\Client\AuthController@register');
    Route::post('login','App\Http\Controllers\Api\Client\AuthController@login');
    Route::get('main/services','App\Http\Controllers\Api\Client\Services@getMainServices');
    Route::get('sub/services','App\Http\Controllers\Api\Client\Services@getSubServices');
    
    Route::middleware('auth:client')->group(function(){
    Route::resource('car',CarController::class);
    Route::resource('address',AddressController::class);
    //show main providers for all sub services
    Route::get('main/{mainId}/show/provider','App\Http\Controllers\Api\Client\ProviderController@mainShowProvider');
    //favourites
    Route::get('show/favourite/providers','App\Http\Controllers\Api\Client\ProviderController@showFavouriteProviders');
    Route::post('favourite/provider/{providerId}','App\Http\Controllers\Api\Client\ProviderController@addProviderToFavourites');
    //show provider profile
    Route::get('show/provider/{providerId}','App\Http\Controllers\Api\Client\ProviderController@showProviderProfile');
 
    Route::get('provider/{providerId}/categories','App\Http\Controllers\Api\Client\ProviderController@showProductCategory');
    //orders
    Route::post('order/public/private','App\Http\Controllers\Api\Client\OrderController@makePublicPrivateOrder');
    Route::post('order/product','App\Http\Controllers\Api\Client\OrderController@makeProductOrder') ;

    Route::get('show/public/orders','App\Http\Controllers\Api\Client\OrderController@showPublicOrders');
    Route::get('show/private/orders','App\Http\Controllers\Api\Client\OrderController@showPrivateOrders');
    Route::get('show/order/{order_id}','App\Http\Controllers\Api\Client\OrderController@showSpecificPublicOrPrivateOrder');
    Route::post('accept/order/{price_id}/{order_id}','App\Http\Controllers\Api\Client\OrderController@acceptPrice');
    Route::post('refuse/order/{price_id}/{order_id}', 'App\Http\Controllers\Api\Client\OrderController@refusePrice');
    Route::post('cancel/order','App\Http\Controllers\Api\Client\OrderController@cancelOrder');
    //cart
    Route::post('add/cart/{product_id}','App\Http\Controllers\Api\Client\OrderController@cart');
    //comment
    Route::post('add/comment/provider/{provider_id}','App\Http\Controllers\Api\Client\OrderController@addCommentToProvider');

    //client
    Route::post('update/client','App\Http\Controllers\Api\Client\AuthController@updateProfile');
    Route::post('reset/password','App\Http\Controllers\Api\Client\AuthController@resetPassword');

    });
    
});

Route::prefix('provider')->group(function(){
Route::post('register','App\Http\Controllers\Api\Provider\AuthController@register');
Route::middleware('auth:provider')->group(function(){
Route::post('subservice/register','App\Http\Controllers\Api\Provider\AuthController@registerServiceTypeForProvider');
Route::post('brandtype/register','App\Http\Controllers\Api\Provider\AuthController@registerBrandTypesForProvider');
Route::post('address/register','App\Http\Controllers\Api\Provider\AuthController@registerAddressforProvider');
Route::post('workhoure/register','App\Http\Controllers\Api\Provider\AuthController@registerWorkHoursForProvider');
Route::resource('product',ProductController::class);
//orders
Route::post('add/price','App\Http\Controllers\Api\Provider\OrderController@addPriceToPublicPrivateOrders');

});
});



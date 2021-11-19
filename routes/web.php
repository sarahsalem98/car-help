<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\MainController;
use App\Http\Controllers\Dashboard\ProviderController;
use App\Http\Controllers\Dashboard\SubMainController;
use App\Http\Livewire\Admin\Main;
use App\Http\Livewire\Admin\Provider as AdminProvider;
use App\Models\Provider;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/main', Main::class);




Route::prefix('admin')->group(function(){
    Route::middleware(['auth:sanctum', 'verified'])->group(function(){
        Route::get('ar',Main::class)->name('dashboard');
        // Route::get('provider',AdminProvider::class)->name('provider');
        Route::resource('provider',ProviderController::class);
        Route::resource('client',ClientController::class);
        Route::resource('admin',AdminController::class);
        Route::resource('service',MainController::class);
        Route::resource('subservice',SubMainController::class);
        
       Route::post('provider/{provider}/update/workHours','App\Http\Controllers\Dashboard\ProviderController@updateWorkHours')->name('workHoure.update');
        Route::post('provider/{provider}/update/brandtypes','App\Http\Controllers\Dashboard\ProviderController@updateBrandTypes')->name('brand.update');
        Route::post('provider/{provider}/suspend','App\Http\Controllers\Dashboard\ProviderController@providerSuspend')->name('privider.suspend');
        
        Route::get('provider/{provider}/show/products','App\Http\Controllers\Dashboard\ProviderController@showProducts')->name('provider.products.show');
        Route::post('provider/search/','App\Http\Controllers\Dashboard\ProviderController@search')->name('provider.search');
        //  Route::put('provider/{provider}','App\Http\Controllers\Dashboard\ProviderController@updateProvider')->name('provider.update');
        //client
        Route::post('client/{client}/suspend','App\Http\Controllers\Dashboard\ClientController@clientsuspend')->name('client.suspend');
        Route::post('client/search/','App\Http\Controllers\Dashboard\ClientController@search')->name('client.search');

        Route::post('service/search','App\Http\Controllers\Dashboard\MainController@search')->name('service.search');

        Route::get('public/orders','App\Http\Controllers\Dashboard\OrderController@publicOrderIndex')->name('public.order.index');
        Route::get('private/orders','App\Http\Controllers\Dashboard\OrderController@privateOrderIndex')->name('private.order.index');
        Route::get('product/orders','App\Http\Controllers\Dashboard\OrderController@productOrderIndex')->name('product.order.index');
 
    });
});

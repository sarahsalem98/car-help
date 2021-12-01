<?php

use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\BannerController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\CancelController;
use App\Http\Controllers\Dashboard\CarModelsController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\ClientController;
use App\Http\Controllers\Dashboard\CopounController;
use App\Http\Controllers\Dashboard\MainController;
use App\Http\Controllers\Dashboard\ProviderController;
use App\Http\Controllers\Dashboard\SubMainController;
use App\Http\Livewire\Admin\Main;
use App\Http\Livewire\Admin\Provider as AdminProvider;
use App\Models\Provider;
use Illuminate\Support\Facades\Artisan;
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


Route::get('/config-clear',function(){
    Artisan::call('config:clear');
});
Route::get('/config-cache',function(){
    Artisan::call('config:cache');
});

Route::get('/route-cache',function(){
    Artisan::call('route:cache');
});

Route::get('/cache-clear',function(){
    Artisan::call('cache:clear');
});


Route::prefix('admin')->group(function () {
    Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('ar', 'App\Http\Controllers\Dashboard\HomeController@showHome')->name('dashboard');
        // Route::get('provider',AdminProvider::class)->name('provider');
        Route::resource('provider', ProviderController::class);
        Route::resource('client', ClientController::class);
        Route::resource('admin', AdminController::class);
        Route::resource('service', MainController::class);
        Route::resource('subservice', SubMainController::class);
        Route::resource('brandType', BrandController::class);
        Route::resource('cancellationReason', CancelController::class);
        Route::resource('carModel', CarModelsController::class);
        Route::resource('city', CityController::class);
        Route::resource('banner', BannerController::class);
        Route::resource('copoun', CopounController::class);

        Route::get('search/admin','App\Http\Controllers\Dashboard\AdminController@searchAdmin')->name('search.admin');
        Route::get('search/submain','App\Http\Controllers\Dashboard\SubMainController@searchSubMain')->name('search.submain');
        Route::get('search/brand','App\Http\Controllers\Dashboard\BrandController@searchbrand')->name('search.brand');
        Route::get('search/Cancel','App\Http\Controllers\Dashboard\CancelController@searchCancel')->name('search.cancel');
        Route::get('search/carModel','App\Http\Controllers\Dashboard\CarModelsController@searchCarModel')->name('search.carModel');
        Route::get('search/city','App\Http\Controllers\Dashboard\CityController@searchCity')->name('search.city');
        Route::get('search/banner','App\Http\Controllers\Dashboard\BannerController@searchbanner')->name('search.banner');
        Route::get('search/copoun','App\Http\Controllers\Dashboard\CopounController@searchCopoun')->name('search.copoun');


        Route::post('provider/{provider}/update/workHours', 'App\Http\Controllers\Dashboard\ProviderController@updateWorkHours')->name('workHoure.update');
        Route::post('provider/{provider}/update/brandtypes', 'App\Http\Controllers\Dashboard\ProviderController@updateBrandTypes')->name('brand.update');
        Route::post('provider/{provider}/suspend', 'App\Http\Controllers\Dashboard\ProviderController@providerSuspend')->name('privider.suspend');

        Route::get('provider/{provider}/show/products', 'App\Http\Controllers\Dashboard\ProviderController@showProducts')->name('provider.products.show');
        Route::post('provider/search/', 'App\Http\Controllers\Dashboard\ProviderController@search')->name('provider.search');
        //  Route::put('provider/{provider}','App\Http\Controllers\Dashboard\ProviderController@updateProvider')->name('provider.update');
        //client
        Route::post('client/{client}/suspend', 'App\Http\Controllers\Dashboard\ClientController@clientsuspend')->name('client.suspend');
        Route::post('client/search/', 'App\Http\Controllers\Dashboard\ClientController@search')->name('client.search');

        Route::post('service/search', 'App\Http\Controllers\Dashboard\MainController@search')->name('service.search');

        Route::get('public/orders', 'App\Http\Controllers\Dashboard\OrderController@publicOrderIndex')->name('public.order.index');
        Route::get('private/orders', 'App\Http\Controllers\Dashboard\OrderController@privateOrderIndex')->name('private.order.index');
        Route::get('product/orders', 'App\Http\Controllers\Dashboard\OrderController@productOrderIndex')->name('product.order.index');

        Route::get('howToUse', 'App\Http\Controllers\Dashboard\HowToUseAndWhoWeAreController@howToUseIndex')->name('howToUse.index');
        Route::post('update/howToUse', 'App\Http\Controllers\Dashboard\HowToUseAndWhoWeAreController@howToUseUpdate')->name('howToUse.update');

        Route::get('whoWeAre', 'App\Http\Controllers\Dashboard\HowToUseAndWhoWeAreController@whoWeareIndex')->name('whoWeAre.index');
        Route::post('update/whoWeAre', 'App\Http\Controllers\Dashboard\HowToUseAndWhoWeAreController@whoWeAreUpdate')->name('whoWeAre.update');

        Route::get('commession', 'App\Http\Controllers\Dashboard\HowToUseAndWhoWeAreController@commessionIndex')->name('commession.index');
        Route::post('update/commission', 'App\Http\Controllers\Dashboard\HowToUseAndWhoWeAreController@commessionUpdate')->name('commession.update');

        Route::get('others', 'App\Http\Controllers\Dashboard\HowToUseAndWhoWeAreController@othersIndex')->name('others.index');

        Route::post('others', 'App\Http\Controllers\Dashboard\HowToUseAndWhoWeAreController@othersUpdate')->name('others.update');
    });
});

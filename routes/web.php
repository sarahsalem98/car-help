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
use App\Http\Controllers\Website\Client\Profile\CarController;
use App\Http\Controllers\Website\Provider\ProductController;
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



Route::get('/main', Main::class);


Route::get('/config-clear', function () {
    Artisan::call('config:clear');
});
Route::get('/config-cache', function () {
    Artisan::call('config:cache');
});

Route::get('/route-cache', function () {
    Artisan::call('route:cache');
});

Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
});




Route::get('language/{locale}', 'App\Http\Controllers\Website\MainController@setLocale')->name('change.lang');
Route::get('/', 'App\Http\Controllers\Website\MainController@getMainPage')->name('main');

Route::get('about/us', 'App\Http\Controllers\Website\MainController@getWhoWeArePage')->name('about.us');
Route::get('/categories', 'App\Http\Controllers\Website\MainController@getCategoryPage')->name('categories');
Route::get('contact/us', 'App\Http\Controllers\Website\MainController@getContactUsPage')->name('contact.us');
Route::post('contact/us', 'App\Http\Controllers\Website\MainController@storeContactUs')->name('contact.us.post');

Route::prefix('provider')->group(function () {
    Route::get('logout', 'App\Http\Controllers\Website\Provider\Auth\LoginController@logout')->name('provider.logout');
    Route::get('login', 'App\Http\Controllers\Website\Provider\Auth\LoginController@loginPage')->name('provider.login.page');
    Route::post('login', 'App\Http\Controllers\Website\Provider\Auth\LoginController@login')->name('provider.login.page.post');

    Route::post('register', 'App\Http\Controllers\Website\Provider\Auth\RegisterController@register')->name('provider.register.first.page.post');
    Route::get('register', 'App\Http\Controllers\Website\Provider\Auth\RegisterController@registerFirstPage')->name('provider.register.first.page');

    Route::get('register/{provider_id}/service/types', 'App\Http\Controllers\Website\Provider\Auth\RegisterCompleteController@registerServiceTypesPage')->name('provider.register.service.type');
    Route::post('register/service/types', 'App\Http\Controllers\Website\Provider\Auth\RegisterCompleteController@registerServiceTypeForProvider')->name('provider.register.service.type.post');

    Route::get('register/{provider_id}/brand/types', 'App\Http\Controllers\Website\Provider\Auth\RegisterCompleteController@registerBrandTypesPage')->name('provider.register.brand.type');
    Route::post('register/brand/types', 'App\Http\Controllers\Website\Provider\Auth\RegisterCompleteController@registerBrandTypes')->name('provider.register.brand.type.post');

    Route::get('register/{provider_id}/address', 'App\Http\Controllers\Website\Provider\Auth\RegisterCompleteController@registerAddressPage')->name('provider.register.address');
    Route::post('register/address', 'App\Http\Controllers\Website\Provider\Auth\RegisterCompleteController@registerAddress')->name('provider.register.address.post');


    Route::get('register/{provider_id}/work/hours', 'App\Http\Controllers\Website\Provider\Auth\RegisterCompleteController@registerWorkHoursPage')->name('provider.register.work_hours');
    Route::post('register/work/hours', 'App\Http\Controllers\Website\Provider\Auth\RegisterCompleteController@registerWorkHours')->name('provider.register.work_hours.post');


    Route::get('verify/{provider_id}', 'App\Http\Controllers\Website\provider\Auth\RegisterCompleteController@verifyPage')->name('provider.verify');
    Route::post('verify', 'App\Http\Controllers\Website\provider\Auth\RegisterCompleteController@verify')->name('provider.verify.post');

    Route::middleware(['auth:providerWeb'])->group(function () {
        Route::get('statistics', 'App\Http\Controllers\Website\Provider\ProfileController@showStatistics')->name('provider.statistics');


        Route::get('profile/update', 'App\Http\Controllers\Website\Provider\ProfileController@updateProfilePage')->name('provider.profile.update');
        Route::post('profile/update', 'App\Http\Controllers\Website\Provider\ProfileController@updateProfile')->name('provider.profile.update.post');
        Route::post('work/hours/update', 'App\Http\Controllers\Website\Provider\ProfileController@updateWorkHours')->name('provider.work.hour.update.post');

        Route::get('address/update','App\Http\Controllers\Website\Provider\ProfileController@updateAddress')->name('provider.address.update');
        Route::put('address/{address_id}/update','App\Http\Controllers\Website\Provider\ProfileController@updatePostAddress')->name('provider.address.update.post');


        Route::get('password/update', 'App\Http\Controllers\Website\Provider\ProfileController@updatePasswordPage')->name('provider.password.update');
        Route::post('password/update', 'App\Http\Controllers\Website\Provider\ProfileController@updatePassword')->name('provider.password.update.post');

        Route::get('service/types/update', 'App\Http\Controllers\Website\Provider\ProfileController@updateServicesPage')->name('provider.services.update');
        Route::Post('service/types/update', 'App\Http\Controllers\Website\Provider\ProfileController@updateServices')->name('provider.services.update.post');

        Route::get('brand/types/update', 'App\Http\Controllers\Website\Provider\ProfileController@updateBrandsPage')->name('provider.brands.update');
        Route::post('brand/types/update', 'App\Http\Controllers\Website\Provider\ProfileController@updateBrands')->name('provider.brands.update.post');

        Route::get('services', 'App\Http\Controllers\Website\Provider\Order\PublicPrivateController@showPublicePrivateOrders')->name('provider.services');
        Route::get('new/service/{service_id}', 'App\Http\Controllers\Website\Provider\Order\PublicPrivateController@showPublicPrivateNewOrder')->name('provider.service.show');
        Route::get('now/service/{service_id}', 'App\Http\Controllers\Website\Provider\Order\PublicPrivateController@showPublicPrivateNowOrder')->name('provider.service.now.show');
        Route::get('completed/service/{service_id}', 'App\Http\Controllers\Website\Provider\Order\PublicPrivateController@showPublicPrivateCompleteOrder')->name('provider.service.complete.show');
        Route::get('canceled/service/{service_id}', 'App\Http\Controllers\Website\Provider\Order\PublicPrivateController@showPublicPrivateCancelOrder')->name('provider.service.cancel.show');





        Route::post('complete/service', 'App\Http\Controllers\Website\Provider\Order\PublicPrivateController@acceptService')->name('provider.complete,service');
        Route::post('servic/send/price', 'App\Http\Controllers\Website\Provider\Order\PublicPrivateController@sendPrice')->name('provider.price.send');
        Route::post('service/send/cancel/reasons', 'App\Http\Controllers\Website\Provider\Order\PublicPrivateController@sendCancelReasons')->name('provider.cancellation.reasons.post');

        Route::get('orders', 'App\Http\Controllers\Website\Provider\Order\ProductController@showProducteOrders')->name('provider.orders');
        Route::get('new/order/{order_id}', 'App\Http\Controllers\Website\Provider\Order\ProductController@showProductNewOrder')->name('provider.order.new.show');
        Route::get('accepted/order/{order_id}', 'App\Http\Controllers\Website\Provider\Order\ProductController@showIsAccepted')->name('provider.order.is.accepted.show');
        Route::post('accepted/order/{order_id}', 'App\Http\Controllers\Website\Provider\Order\ProductController@acceptOrder')->name('provider.order.is.accepted.show.post');

        Route::get('prepared/order/{order_id}', 'App\Http\Controllers\Website\Provider\Order\ProductController@showIsPrepared')->name('provider.order.is.prepared.show');
        Route::post('prepared/order/{order_id}', 'App\Http\Controllers\Website\Provider\Order\ProductController@prepareOrder')->name('provider.order.is.prepared.show.post');

        Route::post('deliverd/order', 'App\Http\Controllers\Website\Provider\Order\ProductController@delivereOrder')->name('provider.order.is.delivered.show.post');

        Route::get('completed/order/{order_id}', 'App\Http\Controllers\Website\Provider\Order\ProductController@showComplete')->name('provider.order.is.complete.show');
        Route::get('canceled/order/{order_id}', 'App\Http\Controllers\Website\Provider\Order\ProductController@showCancel')->name('provider.order.is.canceled.show');
        //products

        Route::resource('yield', ProductController::class);

        Route::get('notifications', 'App\Http\Controllers\Website\Provider\ProfileController@notifications')->name('provider.notifications');
    });
});
Route::prefix('client')->group(function () {
    Route::get('register', 'App\Http\Controllers\Website\Client\Auth\RegisterController@registerPage')->name('client.register');
    Route::post('register', 'App\Http\Controllers\Website\Client\Auth\RegisterController@register')->name('client.register.post');


    Route::get('verify/{client_id}', 'App\Http\Controllers\Website\Client\Auth\RegisterController@verifyPage')->name('client.verify');
    Route::post('verify', 'App\Http\Controllers\Website\Client\Auth\RegisterController@verify')->name('client.verify.post');


    Route::get('login', 'App\Http\Controllers\Website\Client\Auth\LoginController@loginPage')->name('client.login');
    Route::post('login', 'App\Http\Controllers\Website\Client\Auth\LoginController@login')->name('client.login.post');

    Route::get('logout', 'App\Http\Controllers\Website\Client\Auth\LoginController@logout')->name('client.logout');
    Route::middleware(['auth:clientWeb'])->group(function () {

        Route::get('profile/update', 'App\Http\Controllers\Website\Client\Profile\UpdateController@updateProfilePage')->name('client.profile.update');
        Route::post('profile/update', 'App\Http\Controllers\Website\Client\Profile\UpdateController@updateProfile')->name('client.profile.update.post');

        Route::get('password/update', 'App\Http\Controllers\Website\Client\Profile\UpdateController@updatePasswordPage')->name('client.password.update');
        Route::post('password/update', 'App\Http\Controllers\Website\Client\Profile\UpdateController@updatePassword')->name('client.password.update.post');

        Route::get('profile/orders', 'App\Http\Controllers\Website\Client\Profile\OrderController@orderIndex')->name('client.orders');


        Route::get('addresses', 'App\Http\Controllers\Website\Client\Profile\AddressController@addressIndex')->name('client.address');
        Route::get('address/{address_id}/edit','App\Http\Controllers\Website\Client\Profile\AddressController@edit')->name('client.address.edit');
        Route::put('address/{address_id}/update','App\Http\Controllers\Website\Client\Profile\AddressController@update')->name('client.address.update');
        Route::post('address/add','App\Http\Controllers\Website\Client\Profile\AddressController@add')->name('client.address.add.post');
        Route::get('address/add','App\Http\Controllers\Website\Client\Profile\AddressController@showAdd')->name('client.address.add');
        Route::delete('address/{address_id}/delete','App\Http\Controllers\Website\Client\Profile\AddressController@delete')->name('client.address.delete');

        Route::resource('cars', CarController::class);

        Route::get('sub/categories/{mainCategoryId}', 'App\Http\Controllers\Website\SubCategories\ShowController@indexProvider')->name('subCategories.index');
        Route::get('sub/categories/{mainCategory_id}/provider/{provider_id}', 'App\Http\Controllers\Website\SubCategories\ShowController@showProvider')->name('subCategories.provider.show');


        //order
        Route::post('order', 'App\Http\Controllers\Website\Client\OrderController@makeOrder')->name('public.private.order.post');
        Route::post('car/order', 'App\Http\Controllers\Website\Client\OrderController@makeOrderCar')->name('public.private.car.order.post');

        Route::get('public/order', 'App\Http\Controllers\Website\Client\OrderController@publicOrder')->name('public.order');
        Route::post('public/order', 'App\Http\Controllers\Website\Client\OrderController@makePublicOrder')->name('public.order.post');

        //cart
        Route::get('cart', 'App\Http\Controllers\Website\Client\CartController@showCart')->name('client.cart.show');
        Route::post('cart', 'App\Http\Controllers\Website\Client\CartController@updateCart')->name('client.cart.post');
        Route::post('add/to/cart','App\Http\Controllers\Website\Client\CartController@postCart')->name('client.cart.add');
        Route::post('delete/provider/cart','App\Http\Controllers\Website\Client\CartController@deleteProviderCart')->name('client.cart.provider.delete');
        Route::post('add/to /cart/product','App\Http\Controllers\Website\Client\CartController@postProducrCart')->name('client.product.cart.add');


        //product
        Route::get('product/{mainCategory_id}/{provider_id}/{product_id}', 'App\Http\Controllers\Website\Client\ProductController@showProduct')->name('client.product.show');
        //favouriteProviders
        Route::get('favourite/providers', 'App\Http\Controllers\Website\Client\ProviderController@showFavouriteProviders')->name('client.favourite.providers.show');
        Route::post('favourite/providers/{mainService_id}/{providerId}/{add}', 'App\Http\Controllers\Website\Client\ProviderController@addProviderToFavourites')->name('client.favourite.providers.show.post');

        //orders
        Route::get('profile/product/orders/new/{order_id}', 'App\Http\Controllers\Website\Client\Profile\OrderController@showProductOrderNew')->name('client.product.orders.new.show');
        Route::get('profile/product/orders/now/{order_id}', 'App\Http\Controllers\Website\Client\Profile\OrderController@showProductOrderNow')->name('client.product.orders.now.show');
        Route::post('profile/product/orders/add/comment', 'App\Http\Controllers\Website\Client\Profile\OrderController@addCommentToProvider')->name('client.add.comment.rate');
        Route::get('profile/product/orders/complete/{order_id}', 'App\Http\Controllers\Website\Client\Profile\OrderController@showProductOrderComplete')->name('client.product.orders.complete.show');
        Route::get('profile/product/orders/cancel/{order_id}', 'App\Http\Controllers\Website\Client\Profile\OrderController@showProductOrderCancel')->name('client.product.orders.cancel.show');
        Route::post('profile/cancel/product/orders/new', 'App\Http\Controllers\Website\Client\Profile\OrderController@postClientCancel')->name('client.cancellation.reasons.post');


        Route::get('profile/orders/new/{order_id}', 'App\Http\Controllers\Website\Client\Profile\OrderController@showPrivatePublicOrderNew')->name('client.private.public.orders.new');
        Route::post('order/accept/price', 'App\Http\Controllers\Website\Client\Profile\OrderController@acceptPrice')->name('client.order.accept.price');
        Route::post('order/refuse/price', 'App\Http\Controllers\Website\Client\Profile\OrderController@refusePrice')->name('client.order.refuse.price');


        Route::get('profile/orders/now/{order_id}', 'App\Http\Controllers\Website\Client\Profile\OrderController@showPrivatePublicOrderNow')->name('client.private.public.orders.now');
        Route::get('profile/orders/complete/{order_id}', 'App\Http\Controllers\Website\Client\Profile\OrderController@showPrivatePublicOrderComplete')->name('client.private.public.orders.complete');
        Route::get('profile/orders/canceled/{order_id}', 'App\Http\Controllers\Website\Client\Profile\OrderController@showPrivatePublicOrderCancel')->name('client.private.public.orders.cancel');


        //notifications
        Route::get('notifications', 'App\Http\Controllers\Website\Client\Profile\UpdateController@notifications')->name('client.notifications');
    });
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

        Route::get('search/admin', 'App\Http\Controllers\Dashboard\AdminController@searchAdmin')->name('search.admin');
        Route::get('search/submain', 'App\Http\Controllers\Dashboard\SubMainController@searchSubMain')->name('search.submain');
        Route::get('search/brand', 'App\Http\Controllers\Dashboard\BrandController@searchbrand')->name('search.brand');
        Route::get('search/Cancel', 'App\Http\Controllers\Dashboard\CancelController@searchCancel')->name('search.cancel');
        Route::get('search/carModel', 'App\Http\Controllers\Dashboard\CarModelsController@searchCarModel')->name('search.carModel');
        Route::get('search/city', 'App\Http\Controllers\Dashboard\CityController@searchCity')->name('search.city');
        Route::get('search/banner', 'App\Http\Controllers\Dashboard\BannerController@searchbanner')->name('search.banner');
        Route::get('search/copoun', 'App\Http\Controllers\Dashboard\CopounController@searchCopoun')->name('search.copoun');


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

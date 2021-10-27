<?php

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', function () {
    return view('auth.register');
})->name('register');

Route::get('/verify', function () {
    return view('auth.verify');
})->name('verify');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::post('/', 'App\Http\Controllers\Api\Client\AuthController@register')->name('register');
Route::post('/verify', 'App\Http\Controllers\Api\Client\AuthController@verify')->name('verify');

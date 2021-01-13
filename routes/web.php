<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;

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

Route::get('/errors', function () {
    return App\Models\Store::all()->pluck('invalidFields');
});

Route::get('/errors/{id}', function ($id) {
    return App\Models\Store::all()->where('storeNumber', $id)->pluck('invalidFields');
});

Route::resource('/stores', StoreController::class);

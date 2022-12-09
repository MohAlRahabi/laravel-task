<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

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
    return view('dashboard.index');
})->name('dashboard');

Route::get('get_subscribers',[Admin\SubscriberController::class,'data'])->name('subscribers.data');
Route::resource('subscribers',Admin\SubscriberController::class);

Route::get('get_blogs',[Admin\BlogController::class,'data'])->name('blogs.data');
Route::resource('blogs',Admin\BlogController::class);
Route::delete('blogs/delete_images/{id}',[Admin\BlogController::class,'deleteImage']);

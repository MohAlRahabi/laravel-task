<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('get_uuid',[Controllers\HomeController::class,'generateUuid'])->name('generate_uuid');
Route::get('get_blogs',[Controllers\HomeController::class,'getBlogs'])->name('getBlogs');
Route::get('single_blog/{id?}',[Controllers\HomeController::class,'viewBlog'])->name('viewBlog');

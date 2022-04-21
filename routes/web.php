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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();
Route::resource('home',\App\Http\Controllers\CRUTController::class)->middleware('auth');;
Route::get('/home/category/{id}', [App\Http\Controllers\HomeController::class, 'category'])->middleware('auth')->name('category');
Route::post('/home/category/{id}', [App\Http\Controllers\HomeController::class, 'category_post'])->middleware('auth');
Route::get('/home/category/delete/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])->middleware('auth');
Route::get('/home/category/changes/{id}', [App\Http\Controllers\HomeController::class, 'date'])->middleware('auth')->name('data');;
Route::post('/home/category/changes/{id}', [App\Http\Controllers\HomeController::class, 'changes'])->middleware('auth');



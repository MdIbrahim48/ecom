<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

Route::get('admin/category-list',[CategoryController::class,'categoryList'])->name('categoryList');
Route::post('admin/category-post',[CategoryController::class,'categoryPost'])->name('categoryPost');
Route::get('admin/category-add',[CategoryController::class,'categoryAdd'])->name('categoryAdd');
Route::get('admin/category-edit/{id}',[CategoryController::class,'categoryEdit'])->name('categoryEdit');
Route::post('admin/category-update',[CategoryController::class,'categoryUpdate'])->name('categoryUpdate');
Route::get('admin/category-delete/{id}',[CategoryController::class,'categoryDelete'])->name('categoryDelete');


require __DIR__.'/auth.php';

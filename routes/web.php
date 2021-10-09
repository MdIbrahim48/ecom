<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::get('/',[FrontendController::class,'frontend'])->name('frontend');
Route::get('product/{slug}',[FrontendController::class,'singleProduct'])->name('singleProduct');
Route::get('shop',[FrontendController::class,'shop'])->name('shop');
Route::get('cart',[CartController::class,'cart'])->name('cart');
Route::get('single/cart/{slug}',[CartController::class,'singleCart'])->name('singleCart');



Route::get('dashboard',[DashboardController::class,'dashboard'])->name('dashboard');

// category
Route::get('admin/category-list',[CategoryController::class,'categoryList'])->name('categoryList');
Route::get('admin/category-add',[CategoryController::class,'categoryAdd'])->name('categoryAdd');
Route::post('admin/category-post',[CategoryController::class,'categoryPost'])->name('categoryPost');
Route::get('admin/category-edit/{id}',[CategoryController::class,'categoryEdit'])->name('categoryEdit');
Route::post('admin/category-update',[CategoryController::class,'categoryUpdate'])->name('categoryUpdate');
Route::get('admin/category-delete/{id}',[CategoryController::class,'categoryDelete'])->name('categoryDelete');
// category Trash
Route::get('admin/category-trash/list',[CategoryController::class,'trashList'])->name('trashList');
Route::get('admin/category-trash/restore/{id}',[CategoryController::class,'trashRestore'])->name('trashRestore');
Route::get('admin/category-trash/permanent-deleted/{id}',[CategoryController::class,'trashPermanentDeleted'])->name('trashPermanentDeleted');
Route::post('admin/selected/category-deleted',[CategoryController::class,'categorySelectDeleted'])->name('categorySelectDeleted');

// Sub Category
Route::post('admin/subcategory-post',[SubCategoryController::class,'subCategoryPost'])->name('subCategoryPost');
Route::get('admin/subcategory-list',[SubCategoryController::class,'subCategoryList'])->name('subCategoryList');
Route::get('admin/subcategory-add',[SubCategoryController::class,'subCategoryAdd'])->name('subCategoryAdd');
Route::get('admin/subcategory-edit/{id}',[SubCategoryController::class,'subCategoryEdit'])->name('subCategoryEdit');
Route::post('admin/subcategory-update',[SubCategoryController::class,'subCategoryUpdate'])->name('subCategoryUpdate');
Route::get('admin/subcategory-delete/{id}',[SubCategoryController::class,'subCategoryDelete'])->name('subCategoryDelete');

// Product
Route::get('admin/get-subcat-api/{cat_id}',[ProductController::class,'getSubCategory'])->name('getSubCategory');
Route::get('admin/product-list',[ProductController::class,'productList'])->name('productList');
Route::get('admin/product-add',[ProductController::class,'productAdd'])->name('productAdd');
Route::post('admin/product-post',[ProductController::class,'productPost'])->name('productPost');
Route::get('admin/product-edit/{id}',[ProductController::class,'productEdit'])->name('productEdit');
Route::post('admin/product-update',[ProductController::class,'productUpdate'])->name('productUpdate');





require __DIR__.'/auth.php';

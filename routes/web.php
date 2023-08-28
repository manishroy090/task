<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::controller(CategoriesController::class)->group(function(){
        Route::get('/categories','index')->name('category');
        Route::post('/addcategory','store')->name('category.store');
        Route::get('/editcategory/{id}','edit')->name('category.edit');
        Route::post('/updatecategory/{id}','update')->name('category.update');
        Route::get('/deletecategory/{id}','delete')->name('category.delete');
    });
    Route::controller(BrandController::class)->group(function (){
        Route::get('/brand', 'index')->name('brand.index');
        Route::post('/addbrand','store')->name('brand.store');
        Route::get('brand/edit/{id}','edit')->name('brand.edit');
        Route::post('brand/update/{id}', 'update')->name('brand.update');
        Route::get('/delete{id}', 'delete')->name('brand.delete');
    });
    Route::controller(ProductController::class)->group(function(){
     Route::get('/product', 'index')->name('addproduct');
      Route::post('/store', 'store')->name('store');
      Route::get('/edit/{id}', 'edit')->name('product.edit');
      Route::post('/update/{id}', 'update')->name('product.update');
      Route::get('/delete/{id}', 'delete')->name('product.delete');
      Route::get('/brandlist','brandList')->name('brandlist');
      Route::get('/productslist', 'products')->name('products');
    });





});

require __DIR__.'/auth.php';

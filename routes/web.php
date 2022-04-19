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

Route::group(['middleware' => ['auth:sanctum', 'verified'], 'prefix' => 'dashboard'], function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUDs

    Route::group(['prefix' => 'category'], function () {
        Route::get('/', App\Http\Livewire\Dashboard\Category\Index::class)->name("d-category-index");        // listado
        Route::get('/create', App\Http\Livewire\Dashboard\Category\Save::class)->name("d-category-create");  // crear
        Route::get('/edit/{id}', App\Http\Livewire\Dashboard\Category\Save::class)->name("d-category-edit"); // edit
    });

    Route::group(['prefix' => 'post'], function () {
        Route::get('/', App\Http\Livewire\Dashboard\Post\Index::class)->name("d-post-index");        // listado
        Route::get('/create', App\Http\Livewire\Dashboard\Post\Save::class)->name("d-post-create");  // crear
        Route::get('/edit/{id}', App\Http\Livewire\Dashboard\Post\Save::class)->name("d-post-edit"); // edit
    });
});

Route::group(['prefix' => 'contact'], function () {
    Route::get('/', App\Http\Livewire\Contact\General::class)->name("contact");
});

Route::group(['prefix' => 'blog'], function () {
    Route::get('/', App\Http\Livewire\Blog\Index::class)->name("web-index");
    Route::get('/{slug}', App\Http\Livewire\Blog\Show::class)->name("web-show");
});

Route::group(['prefix' => 'shop'], function () {
    Route::get('/cart-list', App\Http\Livewire\Shop\Cart::class)->name("shop-cart-list");
});

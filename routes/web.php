<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authorcontroller;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GenreController;

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

// Route::get('/roar', function () {
//     return view('welcome');
// });

    
    Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/',[Itemcontroller::class ,'getItems'])->name('getItems');
Route::get('add/{id}',[ItemController::class, 'addToCheckout'])->name('item.addcheckout');
Route::get('/cart', [ItemController::class, 'viewCheckout'])->name('viewCheckout');
Route::get('/checkout/remove/{id}', 'ItemController@removeBookFromCheckout')->name('checkout.remove');
Route::get('/checkout', [ItemController::class, 'checkout'])->name('checkout');
Route::get('/report', [DashboardController::class, 'index'])->name('most.used');    
Route::get('/borrowed',[Itemcontroller::class ,'borrow'])->name('borrow');
Route::get('/reduce/{id}',[Itemcontroller::class ,'reduceQuantity'])->name('reduce');
Route::patch('/book/restore/{id}', [ItemController::class, 'restore'])->name('book.restore');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

Route::get('/book/{id}/delete', [BookController::class, 'destroy']);
Route::get('/genre/{id}/delete', [GenreController::class, 'destroy']);
Route::get('/stock/{id}/delete', [StockController::class, 'destroy']);
Route::get('/author/{id}/delete', [Authorcontroller::class, 'destroy']);

Route::get('/book/{id}/edit', [BookController::class, 'edit']);
Route::get('/genre/{id}/edit', [GenreController::class, 'edit']);
Route::get('/stock/{id}/edit', [StockController::class, 'edit']);
Route::get('/author/{id}/edit', [Authorcontroller::class, 'edit']);
Route::post('/genre/{id}/update', [GenreController::class, 'update']);
Route::post('/stock/{id}/update', [StockController::class, 'update']);
Route::post('/author/{id}/update', [Authorcontroller::class, 'update']);
Route::post('/book/{id}/update', [BookController::class, 'update']);

Route::middleware(['auth'])->group(function () {
Route::get('/transactions/download', 'DashboardController@download')->name('transactions.download');
Route::get('/transactions/history', 'DashboardController@history')->name('user.history');
Route::get('/books/search', 'App\Http\Controllers\BookController@search')->name('books.search');
Route::get('/booktable', 'App\Http\Controllers\BookController@booktable')->name('books.table');
Route::get('/stocktable', 'App\Http\Controllers\BookController@stocktable')->name('stock.table');
Route::get('/genretable', 'App\Http\Controllers\GenreController@getData')->name('genre.table');
Route::get('/authortable', 'App\Http\Controllers\AuthorController@authortable')->name('author.table');
Route::resource('author', 'AuthorController');
Route::resource('genre', 'GenreController');
Route::resource('book', 'BookController');
Route::resource('user', 'UserController');
Route::resource('stocks', 'StockController');
});

















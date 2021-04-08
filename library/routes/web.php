<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\GenreController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'authors'], function(){
   Route::get('', [AuthorController::class, 'index'])->name('author.index');
   Route::get('create', [AuthorController::class, 'create'])->name('author.create');
   Route::post('store', [AuthorController::class, 'store'])->name('author.store');
   Route::get('edit/{author}', [AuthorController::class, 'edit'])->name('author.edit');
   Route::post('update/{author}', [AuthorController::class, 'update'])->name('author.update');
   Route::post('delete/{author}', [AuthorController::class, 'destroy'])->name('author.destroy');
   Route::get('show/{author}', [AuthorController::class, 'show'])->name('author.show');
});

Route::group(['prefix' => 'books'], function(){
    Route::get('', [BookController::class, 'index'])->name('book.index');
    Route::get('create', [BookController::class, 'create'])->name('book.create');
    Route::post('store', [BookController::class, 'store'])->name('book.store');
    Route::get('edit/{book}', [BookController::class, 'edit'])->name('book.edit');
    Route::post('update/{book}', [BookController::class, 'update'])->name('book.update');
    Route::post('delete/{book}', [BookController::class, 'destroy'])->name('book.destroy');
    Route::get('show/{book}', [BookController::class, 'show'])->name('book.show');
    Route::post('search', [BookController::class, 'search'])->name('book.search');
 });

 Route::group(['prefix' => 'publishers'], function(){
    Route::get('', [PublisherController::class, 'index'])->name('publisher.index');
    Route::get('create', [PublisherController::class, 'create'])->name('publisher.create');
    Route::post('store', [PublisherController::class, 'store'])->name('publisher.store');
    Route::get('edit/{publisher}', [PublisherController::class, 'edit'])->name('publisher.edit');
    Route::post('update/{publisher}', [PublisherController::class, 'update'])->name('publisher.update');
    Route::post('delete/{publisher}', [PublisherController::class, 'destroy'])->name('publisher.destroy');
    Route::get('show/{publisher}', [PublisherController::class, 'show'])->name('publisher.show');
 });

 Route::group(['prefix' => 'genres'], function(){
   Route::get('', [GenreController::class, 'index'])->name('genre.index');
   Route::get('create', [GenreController::class, 'create'])->name('genre.create');
   Route::post('store', [GenreController::class, 'store'])->name('genre.store');
   Route::get('edit/{genre}', [GenreController::class, 'edit'])->name('genre.edit');
   Route::post('update/{genre}', [GenreController::class, 'update'])->name('genre.update');
   Route::post('delete/{genre}', [GenreController::class, 'destroy'])->name('genre.destroy');
   Route::get('show/{genre}', [GenreController::class, 'show'])->name('genre.show');
});
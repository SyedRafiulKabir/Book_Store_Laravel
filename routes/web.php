<?php

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

Route::get('/books', [App\Http\Controllers\BookController::class, 'index'])->name('books.index');
Route::get("/books/create", [App\Http\Controllers\BookController::class, 'create'])->name('books.create');
Route::get("/books/{book}", [App\Http\Controllers\BookController::class, 'show'])->name('books.show');
Route::post("/books", [App\Http\Controllers\BookController::class, 'store'])->name('books.store');
Route::get("/books/{book}/edit", [App\Http\Controllers\BookController::class, 'edit'])->name('books.edit');
Route::put("/books/{book}", [App\Http\Controllers\BookController::class, 'update'])->name('books.update');  
Route::delete("/books/{book}", [App\Http\Controllers\BookController::class, 'destroy'])->name('books.destroy');
Route::get("/get-pdf", [App\Http\Controllers\BookController::class, 'getPdf'])->name('get-pdf');
Route::post('/search', [App\Http\Controllers\BookController::class, 'search'])->name('books.search');
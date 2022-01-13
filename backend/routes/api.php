<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;

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

//books
Route::get('/books', [BookController::class, 'index']);
Route::post('/add-books', [BookController::class, 'store']);
Route::get('/edit-books/{id}', [BookController::class, 'edit']);
Route::put('update-books/{id}', [BookController::class, 'update']);
Route::delete('delete-books/{id}', [BookController::class, 'destroy']);

//loan
Route::get('/loans', [LoanController::class, 'index']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
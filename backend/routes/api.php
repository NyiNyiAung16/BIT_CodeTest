<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ContentOwnerController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/user',function(){
    $user = auth()->user();
    if($user){
        dd($user);
        return $user;
    }else{
        return null;
    }
});
Route::get('/content-owners',[ContentOwnerController::class,'get']);
Route::get('/publishers',[PublisherController::class,'get']);
Route::get('/book-lists',[BookController::class,'get']);
Route::get('/books/{book:book_uniq_idx}/edit',[BookController::class,'getBook']);
Route::delete('/books/{book_uniq_idx}/destroy',[BookController::class,'destroyBook']);
Route::post('/user/create',[UserController::class,'create']);
Route::post('/user/login',[UserController::class,'login']);
Route::post('/book/store',[BookController::class,'store']);
Route::post('/user/logout',[UserController::class,'logout']);
Route::put('/book/{book_uniq_idx}/update',[BookController::class,'editBook']);
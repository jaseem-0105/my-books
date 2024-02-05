<?php

use App\Http\Controllers\MyBookApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('get-all-books', [MyBookApiController::class, 'getAllBooks']);
Route::get('get-latest-books', [MyBookApiController::class, 'getLatestBooks']);
Route::get('get-book/{id}', [MyBookApiController::class, 'getBook']);
Route::post('/store-queries', [MyBookApiController::class, 'storeQueries']);


Route::post('customer-login', [MyBookApiController::class, 'login']);
Route::post('customer-register', [MyBookApiController::class, 'register']);
Route::group(['middleware' => ['jwt.auth']], function () {

    Route::post('place-order', [MyBookApiController::class, 'placeOrder']);
    Route::post('my-orders', [MyBookApiController::class, 'myOrders']);
});

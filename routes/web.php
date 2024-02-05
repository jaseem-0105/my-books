<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\OrderItemsController;
use App\Http\Controllers\Admin\QueryController;
use App\Http\Controllers\DashboardController;
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
    return redirect()->to('/login');
});
Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
Route::prefix('admin')->group(function () {
    Route::resource('books', BookController::class);
    Route::get('/view-orders',[OrderController::class,'viewOrders']);
    Route::get('/view-order-items',[OrderItemsController::class,'viewOrderItems']);
    Route::get('/view-queries',[QueryController::class,'viewQueries']);

});



require __DIR__.'/auth.php';

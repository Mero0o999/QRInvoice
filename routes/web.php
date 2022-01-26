<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;


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
    return view('auth.login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['middleware' => 'auth'], function() {
    Route::get('dashboard', [ProductController::class,'index1'])->name('dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('invoices', InvoiceController::class);

// Route::get('/getPrice/{id}', [ProductController::class,'getPrice']); // for get price list
// Route::get('/findPrice', [ProductController::class,'findPrice']); // for get price list
Route::get('export', [ProductController::class, 'export'])->name('export');
Route::post('import', [ProductController::class, 'import'])->name('import');
Route::get('products.index', [ProductController::class, 'importExportView']);

});





<?php 
use Illuminate\Support\Facades\Route;
use FgutierrezPHP\AddresesRd\Http\Controllers\ProvinceController;


Route::get('/address', [ProvinceController::class, 'index']);

// Route::middleware(['auth'])->group(function () {
//   Route::prefix('tickets')->group(function () {
//     Route::get('/', [TicketsController::class, 'index']);
//   });
// });
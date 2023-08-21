<?php 
use Illuminate\Support\Facades\Route;
use FgutierrezPHP\AddresesRd\Http\Controllers\ProvinceController;
use FgutierrezPHP\AddresesRd\Http\Controllers\MunicipalityController;
use FgutierrezPHP\AddresesRd\Http\Controllers\SectorController;


// Locations
Route::prefix('addresses')->group(function () {
  // Province
  Route::prefix('provincias')->group(function(){
      Route::get('/', [ProvinceController::class, 'get']); 
      Route::post('/', [ProvinceController::class, 'store']); 
      Route::put('/{province}', [ProvinceController::class, 'update']); 
  });
  // Municipality
  Route::prefix('municipios')->group(function(){
      Route::get('/', [MunicipalityController::class, 'get']); 
      Route::post('/', [MunicipalityController::class, 'store']); 
      Route::put('/{municipality}', [MunicipalityController::class, 'update']); 
  });
  // Sector
  Route::prefix('sectores')->group(function(){
      Route::get('/', [SectorController::class, 'get']); 
      Route::post('/', [SectorController::class, 'store']); 
      Route::put('/{sector}', [SectorController::class, 'update']); 
  });
});
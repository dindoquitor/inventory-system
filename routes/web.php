<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\ProcurementController;
use App\Http\Controllers\DryingFacilityController;
use App\Http\Controllers\DryingController;
use App\Http\Controllers\InventoryTypeController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
});

Route::middleware(['auth', 'role:Admin|Staff'])->group(function () {
    Route::get('/regions', [RegionController::class, 'index'])->name('regions.index');
    Route::get('/regions/create', [RegionController::class, 'create'])->name('regions.create');
    Route::post('/regions', [RegionController::class, 'store'])->name('regions.store');
    Route::get('/branches', [BranchController::class, 'index'])->name('branches.index');
    Route::get('/branches/create', [BranchController::class, 'create'])->name('branches.create');
    Route::post('/branches', [BranchController::class, 'store'])->name('branches.store');
    Route::get('/warehouses', [WarehouseController::class, 'index'])->name('warehouses.index');
    Route::get('/warehouses/create', [WarehouseController::class, 'create'])->name('warehouses.create');
    Route::post('/warehouses', [WarehouseController::class, 'store'])->name('warehouses.store');
    Route::get('/farmers', [FarmerController::class, 'index'])->name('farmers.index');
    Route::get('/farmers/create', [FarmerController::class, 'create'])->name('farmers.create');
    Route::post('/farmers', [FarmerController::class, 'store'])->name('farmers.store');
    Route::get('/farmers/{farmer}/edit', [FarmerController::class, 'edit'])->name('farmers.edit');
    Route::put('/farmers/{farmer}', [FarmerController::class, 'update'])->name('farmers.update');
    Route::delete('/farmers/{farmer}', [FarmerController::class, 'destroy'])->name('farmers.destroy');
    Route::get('/procurements', [ProcurementController::class, 'index'])->name('procurements.index');
    Route::get('/procurements/create', [ProcurementController::class, 'create'])->name('procurements.create');
    Route::post('/procurements', [ProcurementController::class, 'store'])->name('procurements.store');
    Route::get('/procurements/{procurement}/edit', [ProcurementController::class, 'edit'])->name('procurements.edit');
    Route::put('/procurements/{procurement}', [ProcurementController::class, 'update'])->name('procurements.update');
    Route::get('/drying-facilities', [DryingFacilityController::class, 'index'])->name('drying-facilities.index');
    Route::get('/drying-facilities/create', [DryingFacilityController::class, 'create'])->name('drying-facilities.create');
    Route::post('/drying-facilities', [DryingFacilityController::class, 'store'])->name('drying-facilities.store');
    Route::get('/dryings', [DryingController::class, 'index'])->name('dryings.index');
    Route::get('/dryings/create', [DryingController::class, 'create'])->name('dryings.create');
    Route::post('/dryings', [DryingController::class, 'store'])->name('dryings.store');
    Route::get('/dryings/{drying}/edit', [DryingController::class, 'edit'])->name('dryings.edit');
    Route::put('/dryings/{drying}', [DryingController::class, 'update'])->name('dryings.update');
    Route::get('/dryings/{drying}/complete', [DryingController::class, 'complete'])->name('dryings.complete');
    Route::put('/dryings/{drying}/complete', [DryingController::class, 'updateReceipt'])->name('dryings.updateReceipt');
    Route::get('/dryings/pending', [App\Http\Controllers\DryingController::class, 'pending'])->name('dryings.pending');
    Route::get('/inventories', [App\Http\Controllers\InventoryController::class, 'index'])->name('inventories.index');
    Route::get('/inventory-types', [App\Http\Controllers\InventoryTypeController::class, 'index'])->name('inventory-types.index');
    Route::post('/inventory-types', [App\Http\Controllers\InventoryTypeController::class, 'store'])->name('inventory-types.store');
    Route::get('/inventory-types', [InventoryTypeController::class, 'index'])->name('inventory-types.index');
    Route::post('/inventory-types', [InventoryTypeController::class, 'store'])->name('inventory-types.store');
});

require __DIR__ . '/auth.php';

<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CafesController;
use App\Http\Controllers\StaffRoleBidController;
use App\Http\Controllers\WorkSlotBidController;
use App\Http\Controllers\WorkSlotController;

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
    return redirect()->route('login');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Profile Routes
Route::prefix('profile')->name('profile.')->middleware('auth')->group(function(){
    Route::get('/', [HomeController::class, 'getProfile'])->name('detail');
    Route::post('/update', [HomeController::class, 'updateProfile'])->name('update');
    Route::post('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
});

// Roles
Route::resource('roles', App\Http\Controllers\RolesController::class);

// Permissions
Route::resource('permissions', App\Http\Controllers\PermissionsController::class);


// Users 
Route::middleware('auth')->prefix('users')->name('users.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{user}', [UserController::class, 'edit'])->name('edit');
    Route::put('/update/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('destroy');
    Route::get('/update/status/{user_id}/{status}', [UserController::class, 'updateStatus'])->name('status');
    Route::get('/import-users', [UserController::class, 'importUsers'])->name('import');
    Route::post('/upload-users', [UserController::class, 'uploadUsers'])->name('upload');
    Route::get('/slots', [UserController::class, 'slots'])->name('slots');
    Route::put('/slots/update/{user}', [UserController::class, 'updateslots'])->name('updateslots');
    Route::get('export/', [UserController::class, 'export'])->name('export');
});


//Cafes
Route::middleware('auth')->prefix('cafes')->name('cafes.')->group(function(){
    Route::get('/view-cafe', [CafesController::class, 'viewcafe'])->name('viewcafe');
    Route::get('/create-cafe', [CafesController::class, 'createcafe'])->name('createcafe');
    Route::post('/store-cafe', [CafesController::class, 'storecafe'])->name('storecafe');
    Route::get('/editcafe/{cafe}', [CafesController::class, 'editcafe'])->name('editcafe');
    Route::put('/updatecafe/{cafe}', [CafesController::class, 'updatecafe'])->name('updatecafe');
    Route::delete('/deletecafe/{cafe}', [CafesController::class, 'destroy'])->name('destroycafe')->withTrashed();
    Route::get('/archivecafe', [CafesController::class, 'archive'])->name('archive');
    Route::get('/recovercafe', [App\Http\Controllers\CafesController::class, 'restore'])->where('id','[0-9]+')->name('restore');
    Route::get('/import-cafes', [CafesController::class, 'importCafes'])->name('import');
    Route::post('/upload-cafes', [CafesController::class, 'uploadCafes'])->name('upload');
    Route::get('export-cafes/', [CafesController::class, 'exportCafes'])->name('export');
});


//Staff Role Bids
Route::middleware(['auth'])->prefix('staffrolebids')->name('staffrolebid.')->group(function() {
    Route::get('/', [StaffRoleBidController::class, 'index'])->name('index');
    Route::get('/create', [StaffRoleBidController::class, 'create'])->name('create');
    Route::post('/store', [StaffRoleBidController::class, 'store'])->name('store');
    Route::get('/{staffRoleBid}/edit', [StaffRoleBidController::class, 'edit'])->name('edit');
    Route::put('/{staffRoleBid}', [StaffRoleBidController::class, 'update'])->name('update');
    Route::delete('/{staffRoleBid}', [StaffRoleBidController::class, 'destroy'])->name('destroy');
});

//Work Slot Bids
Route::middleware(['auth'])->prefix('workslotbids')->name('workslotbid.')->group(function() {
    Route::get('/', [WorkSlotBidController::class, 'index'])->name('index');
    Route::get('/create', [WorkSlotBidController::class, 'create'])->name('create');
    Route::post('/store', [WorkSlotBidController::class, 'store'])->name('store');
    Route::get('/{workSlotBid}/edit', [WorkSlotBidController::class, 'edit'])->name('edit');
    Route::put('/{workSlotBid}', [WorkSlotBidController::class, 'update'])->name('update');
    Route::delete('/{workSlotBid}', [WorkSlotBidController::class, 'destroy'])->name('destroy');
});

//Workslots
Route::middleware(['auth'])->prefix('workslots')->name('workslot.')->group(function() {
    Route::get('/', [WorkSlotController::class, 'index'])->name('index');
    Route::get('/create', [WorkSlotController::class, 'create'])->name('create');
    Route::post('/store', [WorkSlotController::class, 'store'])->name('store');
    Route::get('/edit/{workSlot}', [WorkSlotController::class, 'edit'])->name('edit');
    Route::put('/update/{workSlot}', [WorkSlotController::class, 'update'])->name('update');
    Route::delete('/delete/{workSlot}', [WorkSlotController::class, 'delete'])->name('destroy');
    Route::get('/import-workslot', [WorkSlotController::class, 'importWorkslots'])->name('import');
    Route::post('/upload-workslot', [WorkSlotController::class, 'uploadWorkslots'])->name('upload');
});
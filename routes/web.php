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
Route::resource('staffrolebids', StaffRoleBidController::class);

//Work Slot Bids
Route::resource('workslotbids', WorkSlotBidController::class);
Route::middleware(['auth'])->prefix('workslotsbids')->name('workslotbids.')->group(function() {
    Route::get('/', [WorkSlotBidController::class, 'index'])->name('index');
    Route::get('/create', [WorkSlotBidController::class, 'create'])->name('create');
    Route::post('/store', [WorkSlotBidController::class, 'store'])->name('store');
    Route::get('/{workslotbid}/edit', [WorkSlotBidController::class, 'edit'])->name('edit'); // Use 'workslotbid' instead of 'workslotbids'
    Route::put('/{workslotbid}', [WorkSlotBidController::class, 'update'])->name('update'); // Use 'workslotbid' instead of 'workslotbids'
    Route::delete('/{workslotbid}', [WorkSlotBidController::class, 'destroy'])->name('destroy'); // Use 'workslotbid' instead of 'workslotbids'

});



//Workslots
Route::middleware(['auth'])->prefix('workslots')->name('workslot.')->group(function() {
    Route::get('/', [WorkSlotController::class, 'index'])->name('index');
    Route::get('/create', [WorkSlotController::class, 'create'])->name('create');
    Route::post('/store', [WorkSlotController::class, 'store'])->name('store');
    Route::get('/{workSlot}/edit', [WorkSlotController::class, 'edit'])->name('edit');
    Route::put('/{workSlot}', [WorkSlotController::class, 'update'])->name('update');
    Route::delete('/{workSlot}', [WorkSlotController::class, 'destroy'])->name('destroy');
    
});
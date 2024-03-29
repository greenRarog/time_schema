<?php

use App\Http\Controllers\InfoPageStoreController;
use App\Http\Controllers\AdminViewController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimeSchemaMakeController;
use App\Http\Controllers\TimeSchemaVisorController;
use App\Http\Controllers\TimeSchemaUserController;
use App\Http\Controllers\TimeTableViewController;
use App\Http\Controllers\TimeTableApiController;
use App\Http\Controllers\MainPageViewController;
use App\Http\Controllers\TryTestController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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

Route::get('/try-test', [TryTestController::class, 'index'])->name('try-test');



Route::post('/api/add-reservation', [TimeTableApiController::class, 'addReservation']);
Route::get('/api/get-table', [TimeTableApiController::class, 'getTable']);


Route::get('/info-page/about-project', [MainPageViewController::class, 'view'])->name('main-page');
Route::get('/info-page/{admin_name}', [MainPageViewController::class, 'view'])->name('info-page');


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::post('/create-new-time-schema-user', function(Request $request) {
    dd($request);
});//[TimeSchemaUserController::class, 'createUser']);
Route::get('/create-new-user', [TimeSchemaUserController::class, 'create'])->name('create-new-time-schema-user');


Route::get('create-time-schema', [TimeSchemaVisorController::class, 'create'])->name('create-time-schema');
Route::get('update-time-schema/{id}', [TimeSchemaVisorController::class, 'update'])->name('update-time-schema');

Route::post('api/create-time-schema', [TimeSchemaMakeController::class, 'create']);
Route::post('api/update-time-schema', [TimeSchemaMakeController::class, 'update']);

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/timetable/{id}', [TimeTableViewController::class, 'timetable'])->name('timetable');

    Route::get('/admin', [AdminViewController::class, 'adminPanel'])->name('adminPanel');
    Route::post('/update-mainpage', [InfoPageStoreController::class, 'store'])->name('storeInfoPage');
});
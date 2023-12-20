<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TimeSchemaMakeController;
use App\Http\Controllers\TimeSchemaVisorController;
use App\Http\Controllers\TimeSchemaUserController;
use App\Http\Controllers\TimeTableViewController;
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
Route::get('/main', [TimeSchemaVisorController::class, 'main'])->name('main-page');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
});
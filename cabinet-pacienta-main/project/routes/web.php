<?php

use App\Http\Controllers\DebugController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CreateExamController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
Route::get("/debug", [DebugController::class, "index"]);

Route::get('/', function () {
    return redirect('/profile');
})->middleware('auth');

Route::get('/editExam/{id}', [CreateExamController::class,'indexEditExam'])->name('Edit.exam');
Route::put('/editExam/{id}', [CreateExamController::class,'editExam'])->name('PutEditExam');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/createExam', [CreateExamController::class,'index'])->middleware(['auth', 'verified']);
Route::post('/createExam', [CreateExamController::class, 'store'])->name('store.create')->middleware(['auth', 'verified']);

Route::get('/createDates', [CreateExamController::class,'dates'])->name('create.dates')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::put('/profile/status', [ProfileController::class, 'updateStatus'])->name('status.update');
    
});



require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\CreateExamController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/employeeSchedule", [CreateExamController::class, "dataIndex"]);
Route::get("/schedule", [CreateExamController::class, "dataIndexSchedule"]);
Route::get("/researchSchedule", [CreateExamController::class,"dataResearchindex"]);

Route::get('/download-document', [ProfileController::class, 'conclusion'])->name('exLoad');

Route::get('/date-free', [ProfileController::class, 'freeDate'])->name('freeDate');


    

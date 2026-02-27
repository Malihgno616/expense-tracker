<?php

use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
use App\Models\Expense;
use Illuminate\Support\Facades\Route;

Route::post('/register', [UserController::class, 'register']);  
Route::post('/login', [UserController::class, 'login']);  

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    // Route::get('/expense', [ExpenseController::class, 'index']);
    Route::post('/expense', [ExpenseController::class, 'store']);
    // Route::put('/expense/{id}', [ExpenseController::class, 'update']);
    Route::delete('/expense/{id}', [ExpenseController::class, 'destroy']);
});

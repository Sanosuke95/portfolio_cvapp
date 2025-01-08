<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\FormationController;
use App\Http\Controllers\Api\ResumeController;
use App\Http\Controllers\Api\SkillController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/contact', ContactController::class)->only(['store', 'index', 'show', 'destroy']);

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/resumes', ResumeController::class);
    Route::prefix('resumes/{resume:uuid}')->group(function () {
        Route::apiResource('/skills', SkillController::class);
        Route::apiResource('/formations', FormationController::class);
    })->scopeBindings();
    Route::prefix('user')->group(function () {
        Route::get('/profile', [AuthController::class, 'profile']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::delete('/delete', [AuthController::class, 'destroy']);
    });
});

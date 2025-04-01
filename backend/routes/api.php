<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    TaskController,
    CommentController,
    AttachmentController,
    ProjectController,
    UserController
};

// Tasks routes
Route::apiResource('tasks', TaskController::class);

// Nested routes for comments
Route::prefix('tasks/{task}')->group(function() {
    Route::apiResource('comments', CommentController::class)->only(['index', 'store']);
    Route::post('attachments', [AttachmentController::class, 'store']);
});

// Projects routes
Route::apiResource('projects', ProjectController::class)->only(['index', 'store']);

// Admin routes
Route::middleware('access.control:admin')->prefix('admin')->group(function() {
    Route::apiResource('users', UserController::class)->except(['create', 'edit']);
});

Route::get('/hello', function () {
    return response()->json(['message' => 'Hello World!']);
});

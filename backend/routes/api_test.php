<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\ProjectController;


Route::prefix('api')->group(function() {

//tasks routes
Route::get('/tasks', [TaskController::class, 'index']);
Route::post('/tasks', [TaskController::class, 'store']);
Route::get('/tasks/{id}', [TaskController::class, 'show']);
Route::put('/tasks/{id}', [TaskController::class, 'update']);
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
Route::get('/hello', function () {
    return response()->json(['message' => 'Hello World!']);
});


//Comments routes for task
Route::get('/tasks/{taskId}/comments', [CommentController::class, 'index']);
Route::post('/tasks/{taskId}/comments', [CommentController::class, 'store']);


//File attachments for task
Route::post('/tasks/{taskId}/attachments', [AttachmentController::class, 'store']);

//Project routes
Route::get('/projects', [ProjectController::class, 'index']);
Route::post('/projects', [ProjectController::class, 'store']);


//User management routes protected by acess control middleware
Route::middleware('access.control:admin')->group(function () {
	Route::get('/users', [UserController::class, 'index']);
	Route::put('/users/{id}', [UserController::class, 'update']);
	Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

});
\Illuminate\Support\Facades\Log::info('API routes loaded'); // Debug

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

Route::get('/', [MainController::class, 'index']);
Route::get('/about', function () {
    return view('about');
});
Route::get('/contacts', function () {
    return view('contacts');
});
Route::get('/gallery/{id}', [MainController::class, 'gallery'])->name('gallery');


Route::get('/signin', [AuthController::class, 'create'])->name('signin');
Route::post('/signin', [AuthController::class, 'registration'])->name('registration');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::resource('articles', ArticleController::class);


Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/moderation', [CommentController::class, 'moderation'])->name('comments.moderation')->middleware('auth:sanctum');
Route::post('/comments/{comment}/moderate/{action}', [CommentController::class, 'moderate'])->name('comments.moderate')->middleware('auth:sanctum');


Route::post('/notifications/{notification}/read', function ($notificationId) {
    $notification = auth()->user()->notifications()->findOrFail($notificationId);
    $notification->markAsRead();
    return response()->json(['success' => true]);
})->name('notifications.read')->middleware('auth');
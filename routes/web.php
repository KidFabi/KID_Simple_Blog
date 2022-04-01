<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\CategoryManagerController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Comment\CommentManagerController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\PostManagerController;
use App\Http\Controllers\Post\PublishPostController;
use App\Http\Controllers\Post\RejectPostController;
use App\Http\Controllers\Post\SearchPostController;
use App\Http\Controllers\User\DisableEnableUserCommentsController;
use App\Http\Controllers\User\DownloadUserDataController;
use App\Http\Controllers\User\UserAccountController;
use App\Http\Controllers\User\UserManagerController;
use Illuminate\Support\Facades\Route;

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

// Auth routes
Auth::routes();

// Home
Route::view('/', 'web.static.home')->name('home');

// Posts
Route::get('/posts/search', SearchPostController::class)->name('posts.search');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Comments
Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');
Route::resource('/comments', CommentController::class)->only(['edit', 'update', 'destroy']);

// Privacy Policy
Route::view('/privacy-policy', 'web.static.privacy_policy')->name('privacy_policy');

// Terms of Service
Route::view('/terms-of-service', 'web.static.terms_of_service')->name('terms_of_service');

// Routes accessible only by authenticated users
Route::middleware('auth')->group(function () {
    // User Account Routes
    Route::prefix('account')->name('account.')->group(function () {
        Route::get('/', [UserAccountController::class, 'show'])->name('show');
        Route::patch('update', [UserAccountController::class, 'update'])->name('update');
        Route::delete('delete', [UserAccountController::class, 'destroy'])->name('destroy');
        Route::get('data', DownloadUserDataController::class)->name('data');
    });

    // Manager routes
    Route::prefix('manager')->name('manager.')->group(function () {
        // Dashboard
        Route::get('/dashboard', DashboardController::class)
            ->name('dashboard');

        // Users
        Route::patch('/users/{user}/postComments', DisableEnableUserCommentsController::class)->name('users.post_comments');
        Route::resource('/users', UserManagerController::class)->except(['create', 'store']);

        // Comments
        Route::get('/comments', [CommentManagerController::class, 'index'])->name('comments.index');

        // Posts
        Route::patch('/posts/{post}/publish', PublishPostController::class)->name('posts.publish');
        Route::patch('/posts/{post}/reject', RejectPostController::class)->name('posts.reject');
        Route::resource('/posts', PostManagerController::class);

        // Categories
        Route::resource('categories', CategoryManagerController::class)->except('show');
    });
});
<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CommentController;






Route::middleware(['auth'])->group(function () {

    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
});

Route::get(
    '/home',
    [PostController::class, "index"]
)->name("home");
Route::get(
    '/',
    [PostController::class, "index"]
)->name("home");

Route::get('/login', function () {
    return view('welcome');
})->name("login");

Route::get('/register', function () {
    return view('register');
});

Route::get('/Post_Add', function () {
    return view('Post_Add');
})->name("post.add");

Route::post('/comments', [CommentController::class, 'create'])->name('comments.store');

Route::post('/home', [CustomerController::class, 'addCustomer']);

Route::post('/register', [CustomerController::class, 'addCustomer'])->name('register');

Route::post('/logout', [CustomerController::class, "logout"])->name("logout");

Route::post('/login', [CustomerController::class, 'login'])->name("auth");


Route::post('/post/upload', [PostController::class, "store"])->name('post.upload');
Route::get('/post/edit/{post}', [PostController::class, "edit"])->name('post.edit');
Route::post('/post/edit/{post}', [PostController::class, "update"])->name('post.update');
Route::delete('/post/edit/{post}', [PostController::class, "destroy"])->name('post.delete');
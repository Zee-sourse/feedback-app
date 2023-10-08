<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
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

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/feedbacks',[FeedbackController::class,'index'])->name('feedbacks');
    Route::get('/feedbacks/create',[FeedbackController::class,'create'])->name('feedbacks.create');
    Route::post('/feedbacks/store',[FeedbackController::class,'store'])->name('feedbacks.store');
    Route::get('/feedbacks/show/{id}',[FeedbackController::class,'show'])->name('feedbacks.show');
    Route::post('/feedbacks/upvote',[FeedbackController::class,'upvote'])->name('feedbacks.upvote');
    Route::post('/feedbacks/downvote',[FeedbackController::class,'downvote'])->name('feedbacks.downvote');
    Route::post('/feedbacks/comment/store',[FeedbackController::class,'storeComment'])->name('feedbacks.comments.store');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

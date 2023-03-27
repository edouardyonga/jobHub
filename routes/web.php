<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Common Resource Routes:
// index - Show all listings
// show - Show single listing
// create - Show form to create new listing
// store - Store new listing
// edit - Show form to edit listing
// update - Update listing
// destroy - Delete listing

// all jobs
Route::get('/', [JobController::class, 'index']);

// Create job
Route::get('/jobs/create', [JobController::class, 'create'])->middleware('auth');

// Single job
Route::post('/jobs', [JobController::class, 'store'])->middleware('auth');

// show edit form
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->middleware('auth');

// update job
Route::put('/jobs/{job}', [JobController::class, 'update'])->middleware('auth');

// Single job
Route::get('/jobs/{job}', [JobController::class, 'show']);

// Single job
Route::delete('/jobs/{job}', [JobController::class, 'delete'])->middleware('auth');

// Register Routes
Route::get('/register', [UserController::class, 'show'])->middleware('guest');
Route::post('/register', [UserController::class, 'register'])->middleware('guest');

// Login Routes
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'auth'])->middleware('guest');

// Logout Route
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');



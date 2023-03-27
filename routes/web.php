<?php

use App\Http\Controllers\JobController;
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
Route::get('/jobs/create', [JobController::class, 'create']);

// Single job
Route::post('/jobs', [JobController::class, 'store']);

// show edit form
Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);

// show edit form
Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);

// update job
Route::put('/jobs/{job}', [JobController::class, 'update']);

// Single job
Route::get('/jobs/{job}', [JobController::class, 'show']);

// Single job
Route::delete('/jobs/{job}', [JobController::class, 'delete']);



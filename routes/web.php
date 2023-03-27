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
Route::get('/jobs/{job}', [JobController::class, 'show']);

// Single job
Route::post('/jobs', [JobController::class, 'store']);

// ----------------------------------
Route::get('/hello', function () {
    return response('Hello worl');
});

Route::get('/posts/{id}', function ($id) {
    // ddd($id);
    return response('Post' . $id);
})->where('id', '[0-9]+');

Route::get('/search', function (Request $request) {
    // ddd($id);
    return response($request->name . "" . $request->age);
});

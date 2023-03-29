<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', function () {
    // ddd($id);
    return response()->json([
        'posts' => [
            [
                'title' => 'post one',
                'age' => '12'
            ],
            [
                'title' => 'post one',
                'age' => '12'
            ]
        ]
    ]);
});
// ------------------------------------

/*
|
| GET Routes
|
*/
// all teams Route
Route::get('/teams', [TeamController::class, 'index']);

// single team Route
Route::get('/teams/{id}', [TeamController::class, 'show']);

// all members Route
Route::get('/members', [MemberController::class, 'index']);

// single member Route
Route::get('/members/{id}', [MemberController::class, 'show']);

// Create member Route
Route::post('/members', [MemberController::class, 'store']);

// delete member Route
Route::delete('/members', [MemberController::class, 'destroy']);

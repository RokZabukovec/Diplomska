<?php

use App\Http\Controllers\CommandController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SnippetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/user/teams', function (Request $request) {
    return $request->user()->allTeams();
});

Route::apiResource('projects', ProjectController::class)->middleware('auth:sanctum');

Route::put('/projects/{project}/pin', [ProjectController::class, 'pin'])->name('projects.pin');

Route::apiResource('commands', CommandController::class)->middleware('auth:sanctum');

Route::apiResource('pages', PageController::class)->middleware('auth:sanctum');

Route::apiResource('links', LinkController::class)->middleware('auth:sanctum');

Route::apiResource('snippets', SnippetController::class)->middleware('auth:sanctum');

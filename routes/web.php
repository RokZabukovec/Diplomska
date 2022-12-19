<?php

use App\Http\Controllers\web\CommandController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\web\ProjectController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::inertia('/dashboard', 'ProjectsTable')->name('projects');
    Route::get('/project/{project:id}', [ProjectController::class, 'show'])->name('project');
    Route::get('/command/{command:id}/edit', [CommandController::class, 'edit'])->name('command.edit');
});

Route::Resource('projects', ProjectController::class)->middleware('auth');

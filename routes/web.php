<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\web\CommandController;
use App\Services\PageContextService;
use Illuminate\Support\Facades\Auth;
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
    Route::get('/dashboard', function () {
        return Inertia::render('ProjectsTable');
    })->name('projects');

    Route::get('/project/{project:id}', [ProjectController::class, 'show'])->name('project');
    Route::get('/project/{project:id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::get('/command/{command:id}/edit', [CommandController::class, 'edit'])->name('command.edit');
    Route::get('/search', [SearchController::class, 'show'])->name('search.show');

    Route::group(['middleware' => 'super-user'], function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    });
});

Route::Resource('projects', ProjectController::class)->middleware('auth');

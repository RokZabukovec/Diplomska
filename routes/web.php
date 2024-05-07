<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DocumentationController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StatisticsController;
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

Route::get('/documentation', [DocumentationController::class, 'index'])->name('index');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/search', function () {
        return Inertia::render('Search');
    })->name('projects');

    Route::get('/project/{project:id}', [ProjectController::class, 'show'])->name('project');
    Route::get('/project/{project:id}/edit', [ProjectController::class, 'edit'])->name('project.edit');
    Route::get('/command/{command:id}/edit', [CommandController::class, 'edit'])->name('command.edit');
    Route::get('/search', [SearchController::class, 'show'])->name('search.show');
    Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');

    Route::group(['middleware' => 'super-user'], function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
    });
});

Route::Resource('projects', ProjectController::class)->middleware('auth');

Route::get('/login/google', [GoogleLoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/login/google/callback', [GoogleLoginController::class, 'handleGoogleCallback']);

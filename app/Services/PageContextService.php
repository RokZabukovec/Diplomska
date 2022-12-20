<?php

namespace App\Services;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

class PageContextService
{
    public static function getContext() : array
    {
        $user = auth()->user();
        $team = $user->personalTeam();
        $teamMembers = $team->allUsers();
        return [
            'team' => $team,
            'user' => auth()->user(),
            'members' => $teamMembers,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ];
    }

}

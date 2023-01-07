<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

class PageContextService
{
    public static function getContext() : array
    {
        $user = auth()->user();
        $team = $user?->personalTeam();
        $teamMembers = $team?->allUsers();
        $isSuperUser = $user instanceof User ? $user->hasRole('super-user') : false;
        return [
            'app_name' => env('APP_NAME', 'Laravel'),
            'team' => $team,
            'user' => $user,
            'isSuperUser' => $isSuperUser,
            'members' => $teamMembers,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ];
    }

}

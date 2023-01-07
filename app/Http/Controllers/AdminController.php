<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function index(Request $request): Response
    {
        $commands = DB::table('commands')->count();
        $projects = DB::table('projects')->count();
        $users = DB::table('users')->count();

        return Inertia::render('AdminPanel', ['user_count' => $users, 'project_count' => $projects, 'command_count' => $commands]);
    }
}

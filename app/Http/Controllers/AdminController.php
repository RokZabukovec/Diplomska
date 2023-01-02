<?php

namespace App\Http\Controllers;

use App\Services\PageContextService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('AdminPanel');
    }
}

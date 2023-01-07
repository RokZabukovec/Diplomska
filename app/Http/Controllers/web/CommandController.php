<?php

namespace App\Http\Controllers\web;

use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Command;

class CommandController extends Controller{

    public function edit(Request $request, Command $command) {
        return Inertia::render('CommandEditForm', ['command' => $command]);
    }
}

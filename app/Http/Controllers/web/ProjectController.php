<?php

namespace App\Http\Controllers\web;

use Inertia\Inertia;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param Project $project
     *
     * @return \Inertia\Response
     */
    public function show(Project $project): \Inertia\Response
    {
        return Inertia::render('ProjectContentSelection', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     *
     * @return Response
     */
    public function edit(Project $project)
    {
        return Inertia::render('ProjectContentSelection', ['project' => $project]);
    }

}

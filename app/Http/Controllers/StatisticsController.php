<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render("Statistics/Index");
    }
}

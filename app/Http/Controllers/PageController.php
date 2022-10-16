<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageStoreRequest;
use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $project_id = $request->get('project_id', 0);

        return Page::where(['project_id' => $project_id])->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PageStoreRequest $request
     * @return PageResource
     */
    public function store(PageStoreRequest $request): PageResource
    {
        $page = Page::create($request->validated());
        return new PageResource($page);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return \Inertia\Response
     */
    public function show(Page $page)
    {
        return Inertia::render('ShowPage', ['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     * @return Response
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Page $page
     * @return Response
     */
    public function update(Request $request, Page $page)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return Response
     */
    public function destroy(Page $page)
    {
        //
    }
}

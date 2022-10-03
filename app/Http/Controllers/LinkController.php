<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $project_id = $request->get('project_id', 0);

        return Link::where(['project_id' => $project_id])->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LinkRequest $request
     * @return LinkResource
     */
    public function store(LinkRequest $request): LinkResource
    {
        $link = Link::create($request->validated());
        return new LinkResource($link);
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
     * @param Link $link
     * @return Response
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Link $link
     * @return Response
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Link $link
     * @return Response
     */
    public function update(Request $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Link $link
     * @return Response
     */
    public function destroy(Link $link)
    {
        //
    }
}

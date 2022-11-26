<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandStoreRequest;
use App\Http\Resources\CommandResource;
use App\Models\Command;
use App\Repositories\CommandRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommandController extends Controller
{
    private CommandRepository $commands;

    public function __construct(CommandRepository $commands)
    {
        $this->commands = $commands;
    }

    /**
     * Display a listing of the resource.
     *
     * @return CommandResource
     */
    public function index(Request $request)
    {
        $project_id = $request->get('project_id', 0);
        $people = $request->get('people', 0);
        $commands = $this->commands->getAll($project_id);
        return new CommandResource($commands);
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
     * Store a newly created resource in storage.
     *
     * @param CommandStoreRequest $request
     * @return CommandResource
     */
    public function store(CommandStoreRequest $request): CommandResource
    {
        $new = $this->commands->store($request);
        return new CommandResource($new);
    }

    /**
     * Display the specified resource.
     *
     * @param Command $command
     * @return Response
     */
    public function show(Command $command)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Command $command
     * @return Response
     */
    public function edit(Command $command)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Command $command
     * @return Response
     */
    public function update(Request $request, Command $command)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Command $command
     * @return Response
     */
    public function destroy(Command $command)
    {
        //
    }
}

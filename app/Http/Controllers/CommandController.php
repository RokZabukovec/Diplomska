<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandStoreRequest;
use App\Http\Resources\CommandResource;
use App\Http\Resources\ProjectResource;
use App\Models\Command;
use App\Models\ExternalCommand;
use App\Repositories\CommandRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JetBrains\PhpStorm\NoReturn;

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
        return new CommandResource($command);
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
        $data = $request->all();
        if (!empty($data['tags'])) {
            $command->syncTags($data['tags']);
        }

        $command->update($data);
        return $command;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Command $command
     * @return Response
     */
    public function destroy(Command $command)
    {
        return $command->delete();
    }

    /**
     * Display a listing of the external commands resource.
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function external(Request $request): LengthAwarePaginator
    {
        $platform = $request->query('platform');

        $query = ExternalCommand::query()
            ->select('id', 'created_at', 'updated_at', 'deleted_at', 'command', 'description', 'pre', 'platform')
            ->when($platform, function ($query) use ($platform) {
                return $query->where('platform', $platform);
            })
            ->orderBy('created_at', 'desc'); // You can change the sorting as per your requirement

        $perPage = $request->input('perPage', 10); // Number of records per page, default is 10
        return $query->paginate($perPage);
    }
}

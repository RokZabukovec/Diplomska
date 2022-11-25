<?php

namespace App\Http\Controllers;

use App\Helpers\CacheKey;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use App\Models\User;
use App\Repositories\ProjectRepository;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class ProjectController extends Controller
{
    private ProjectRepository $projects;

    public function __construct(ProjectRepository $projects)
    {
        $this->projects = $projects;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return ProjectResource
     */
    public function index(Request $request): ProjectResource
    {
        $user_id = $request->user()->id;
        $projects = $this->projects->getAll($user_id);
        return new ProjectResource($projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectStoreRequest $request
     * @return ProjectResource
     */
    public function store(ProjectStoreRequest $request): ProjectResource
    {
        $new = $this->projects->store($request);
        return new ProjectResource($new);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * @param Project $project
     * @return ProjectResource
     * @throws AuthorizationException
     */
    public function destroy(Project $project): ProjectResource
    {
        $this->authorize('delete', $project);
        $this->projects->destroy($project);
        return new ProjectResource($project);
    }

    public function pin(Request $request, Project $project)
    {
        $project->pined = !$project->pined;
        $saved = $project->save();

        if ($saved){
            $key = Str::replace('?', $request->user()->id, 'all_projects_from_user_?');
            Cache::forget($key);
            return $project;
        }
        return new BadRequestException();
    }

    public function teamsProjects(Request $request){
        
        $user = request()->user()->id;

        return Project::where('user_id', $user)->get();
    }
}

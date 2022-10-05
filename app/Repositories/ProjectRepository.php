<?php

namespace App\Repositories;


use App\Helpers\CacheKey;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProjectStoreRequest;
use App\Models\Project;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use LogicException;

class ProjectRepository implements RepositoryInterface
{

    public function getAll(int $user_id): array
    {
        $projects = Project::where(['user_id' => $user_id])
            ->get();
        $pined = Project::where(['user_id' => $user_id, 'pined' => true])
            ->get();

        return [
            'projects' => $projects,
            'pined' => $pined
        ];
    }

    public function store(ProjectStoreRequest $request): ?Project
    {
        $project = Project::create(
            array_merge($request->validated(),
                ['user_id' => $request->user()->id]));

        if ($project instanceof Project){
            $key = Str::replace('?', $request->user()->id, 'all_projects_from_user_?');
            Cache::forget($key);
            return $project;
        }
        return null;
    }

    public function destroy(Project $project): ?bool
    {
        try {
            $deleted = $project->delete();
            $key = Str::replace('?', $project->user_id, CacheKey::$userProjects);
            Cache::forget($key);
            return $deleted;
        }catch (LogicException){
            return false;
        }
    }
}

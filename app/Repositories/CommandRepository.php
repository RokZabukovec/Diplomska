<?php

namespace App\Repositories;

use App\Helpers\CacheKey;
use App\Http\Requests\CommandStoreRequest;
use App\Models\Command;
use App\Models\Project;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Pagination\LengthAwarePaginator;

class CommandRepository implements RepositoryInterface
{
    public function getAll(int $project_id): LengthAwarePaginator
    {
        return Command::where(['project_id' => $project_id])->with('tags')->paginate(5);
    }

    public function store(CommandStoreRequest $request): ?Command
    {
        $validated = $request->validated();
        $command = Command::create($validated);
        if (!empty($validated['tags'])) {
            $command->syncTags($validated['tags']);
        }

        if ($command instanceof Command) {
            $key = Str::replace('?', $command->project_id, CacheKey::$userCommands);
            Cache::forget($key);
            return $command;
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
        } catch (LogicException) {
            return false;
        }
    }
}

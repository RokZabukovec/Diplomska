<?php

namespace App\Repositories;

use App\Helpers\CacheKey;
use App\Http\Requests\CommandStoreRequest;
use App\Models\Command;
use App\Models\Project;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CommandRepository implements RepositoryInterface
{
    public function getAll(int $project_id): Collection
    {
        $key = Str::replace('?', $project_id, CacheKey::$userCommands);

        return Cache::rememberForever($key, function () use ($project_id) {
            return Command::where(['project_id' => $project_id])->with('tags')->get();
        });
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

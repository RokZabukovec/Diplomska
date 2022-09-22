<?php

namespace App\Repositories;


use App\Models\Project;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ProjectRepository implements RepositoryInterface
{

    public function getAll(int $user_id): Collection
    {
        $key = Str::replace('?', $user_id, 'all_projects_from_user_?');

        return Cache::rememberForever($key, function() use ($user_id) {
            return Project::where(['user_id' => $user_id])->get();
        });
    }
}

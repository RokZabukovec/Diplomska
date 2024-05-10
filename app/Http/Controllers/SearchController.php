<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Command;
use App\Models\ExternalCommand;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class SearchController extends Controller
{
    public function show(Request $request): Response
    {
        return Inertia::render('Search');
    }

    public function search(SearchRequest $request): JsonResponse
    {
        // Extract request parameters
        $searchTerm = $request->input('q', '');
        $model = $request->input('model', 'projects');

        // Perform search based on the model
        return match ($model) {
            'projects' => $this->searchProjects($request, $searchTerm),
            'team_members' => $this->searchTeamMembers($request, $searchTerm),
            'commands' => $this->searchCommands($request, $searchTerm),
            default => response()->json(),
        };
    }

    public function searchAll(SearchRequest $request): JsonResponse
    {
        // Extract request parameters
        $searchTerm = $request->input('q', '');
        $model = $request->input('model', 'commands');

        // Perform search based on the model
        return match ($model) {
            'projects' => $this->searchProjects($request, $searchTerm),
            'team_members' => $this->searchTeamMembers($request, $searchTerm),
            'commands' => $this->searchAllCommands($request, $searchTerm),
            default => response()->json(),
        };
    }

    protected function searchProjects(SearchRequest $request, string $searchTerm): JsonResponse
    {
        $teamUsers = $request->user()->currentTeam->allUsers()->pluck('id')->toArray();

        $user = $request->input('user_id');

        $query = Project::search($searchTerm)
            ->whereIn('user_id', $teamUsers);

        if ($user !== null) {
            $query->where('user_id', $user);
        }

        $query->latest();

        $results = $query->paginateRaw(10);

        return response()->json($results);
    }

    protected function searchTeamMembers(SearchRequest $request, string $searchTerm): JsonResponse
    {
        // Get current user's team users
        $teamUsers = $request->user()->currentTeam->allUsers()->pluck('id')->toArray();

        // Perform search query
        $query = User::search($searchTerm)
            ->whereIn('id', $teamUsers);

        // Paginate the query results
        $results = $query->paginateRaw(10);

        // Return paginated results as JSON response
        return response()->json($results);
    }

    protected function searchAllCommands(SearchRequest $request, $searchTerm): JsonResponse
    {
        $teamUsers = $request->user()->currentTeam->allUsers()->pluck('id')->toArray();

        $externalQuery = ExternalCommand::search($searchTerm)->get()->toArray();
        $query = Command::search($searchTerm)->whereIn('user_id', $teamUsers)->get()->toArray();

        return response()->json(array_merge($query, $externalQuery));

    }


    protected function searchCommands(SearchRequest $request, string $searchTerm): JsonResponse
    {
        $tag = $request->input('tag');
        $projectId = $request->input('project_id');
        $member = $request->input('member');
        $all = $request->input('all', false);

        if ($all){
            return response()->json($this->SearchAllCommands($searchTerm));
        }

        if ($projectId == -1){
            $query = ExternalCommand::search($searchTerm)
                ->when($tag, function ($query) use ($tag) {
                    $query->where('platform', $tag);
                });

            $results = $query->paginateRaw(100);

            return response()->json($results);
        }

        $teamUsers = $request->user()->currentTeam->allUsers()->pluck('id')->toArray();

        $query = Command::search($searchTerm)
            ->when($tag, function ($query) use ($projectId, $tag) {
                $query->where('tags', $tag);
            })
            ->when($projectId, function ($query) use ($projectId) {
                $query->where('project_id', $projectId);
            })
            ->when(empty($member), function ($query) use ($teamUsers) {
                $query->whereIn('user_id', $teamUsers);
            }, function ($query) use ($member) {
                $query->where('user_id', $member);
            });

        $results = $query->paginateRaw(10);

        return response()->json($results);
    }
}

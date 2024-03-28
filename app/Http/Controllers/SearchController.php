<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Command;
use App\Models\ExternalCommand;
use App\Models\Project;
use App\Models\User;
use App\Services\PageContextService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Scout\Builder;

class SearchController extends Controller
{
    public function show(Request $request): Response
    {
        return Inertia::render('Search');
    }

    public function search(SearchRequest $request): JsonResponse
    {
        // Extract search parameters from the request
        $searchTerm = $request->input('q', '');
        $member = $request->input('member');
        $model = $request->input('model', 'projects');
        $project_id = $request->input('project_id');

        $user = $request->user();

        $teamUsers = $user->currentTeam->allUsers()->pluck('id')->toArray();

        switch ($model) {
            case 'projects':
                $query = Project::search($searchTerm)->whereIn('user_id', $teamUsers)->latest()->raw();

                return response()->json($query);
            case 'team_members':
                $query = User::search($searchTerm)->whereIn('id', $teamUsers);
                break;
            case 'commands':
                $query = Command::search($searchTerm);
                if (isset($project_id)){
                    $query->where('project_id', $project_id);
                }
                $externalQuery = ExternalCommand::search($searchTerm);

                if (!empty($member)) {
                    $query->where('user_id', $member);
                } else {
                    $query->whereIn('user_id', $teamUsers);
                }

                $responseData = [
                    'commands' => $query->paginate(10),
                    'external' => $externalQuery->paginate(10),
                ];

                return response()->json($responseData);
            default:
                return response()->json([]);
        }

        $results = $query->paginate(10);

        return response()->json($results);
    }

}

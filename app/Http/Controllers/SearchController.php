<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Models\Project;
use App\Models\User;
use App\Services\PageContextService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function show(Request $request){
        return Inertia::render('Search');
    }

    public function search(Request $request){
        $searchTerm = $request->get("q", "");

        $user = request()->user();
        $member = $request->get("member");
        $teams = $user->personalTeam();
        $users = $teams->allUsers()->pluck("id")->toArray();

        $query = Command::search($searchTerm);

        if (!empty($member)) {
            $query->where('user_id', $member);
        }
        else{
            $query->whereIn('user_id', $users);
        }

        $commands = $query->paginate(10);

        $model = $request->get("model", "project");
        //dd($model);
        return match ($model) {
            "project" => Project::Search($searchTerm)->paginate(10),
            "commands" => Command::Search($searchTerm)->paginate(10),
            "users" => User::Search($searchTerm)->paginate(10),
            default => response()->json($commands),
        };

    }
}

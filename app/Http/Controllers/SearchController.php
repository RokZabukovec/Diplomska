<?php

namespace App\Http\Controllers;

use App\Models\Command;
use App\Services\PageContextService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function show(Request $request){
        return Inertia::render('Search', ['context' => PageContextService::getContext()]);
    }

    public function search(Request $request){
        $query = $request->get("q", "");
        $user = request()->user();
        $member = $request->get("member");
        $teams = $user->personalTeam();
        $users = $teams->allUsers()->pluck("id")->toArray();

        $query = Command::search($query);

        if (!empty($member)) {
            $query->where('user_id', $member);
        }
        else{
            $query->whereIn('user_id', $users);
        }

        $commands = $query->paginate(10);

        return response()->json($commands);
    }
}

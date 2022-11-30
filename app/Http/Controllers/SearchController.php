<?php

namespace App\Http\Controllers;

use App\Models\Command;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $query = $request->get("q", "*");
        $project_id = $request->get("project", null);
        $user = request()->user();
        $team = $user->personalTeam();
        $users = $team->allUsers()->pluck('id')->toArray();
        $query = Command::search($query)
        ->whereIn('user_id', $users);

        if(is_numeric($project_id)){
            $query->where("project_id", $project_id);
        }
        $commands = $query->paginate(20);
        return response()->json($commands);
    }
}

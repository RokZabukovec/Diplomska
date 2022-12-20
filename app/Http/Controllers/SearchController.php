<?php

namespace App\Http\Controllers;

use App\Models\Command;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $query = $request->get("q", "");
        $user = request()->user();
        $teams = $user->personalTeam();
        $users = $teams->allUsers()->pluck("id")->toArray();

        $commands = Command::search($query)
        ->whereIn('user_id', $users)
        ->paginate(10);

        return response()->json($commands);
    }
}

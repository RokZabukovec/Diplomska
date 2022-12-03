<?php

namespace App\Http\Controllers;

use App\Models\Command;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request){
        $query = $request->get("q", "");
        $user = request()->user();
        $teams = $user->allTeams();
        $commands = Command::search($query)
        ->where('user.id', $user->id)
        ->get();

        return response()->json($commands);
    }
}

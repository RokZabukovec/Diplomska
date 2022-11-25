<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function switchTeam(Request $request){
        try{
            $team_id = request()->get('team_id', 0);
            if(!empty($team_id) && $team_id > 0) {
                $user = request()->user();
                $user->current_team_id = $team_id;
                if($user->save()){
                    return response()->json([
                        'message' => 'Success',
                        'status_code' => 200
                    ]);
                }
            }

        }catch(\Exception $e){
            return response()->json([
                'message' => $e->getMessage(),
                'status_code' => 500
            ], 500);
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle(): RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser){
            $existingUser->google_id = $user->getId();
            $existingUser->name = $user->getName();
            $existingUser->save();

            auth()->login($existingUser, true);

            if (!$existingUser->current_team_id) {
                $this->createPersonalTeam($existingUser);
            }
        }
        else{
            $newUser = new User();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->google_id = $user->getId();
            $newUser->password = bcrypt(request(Str::random()));
            $newUser->save();

            auth()->login($newUser, true);

            // Create a personal team for the new user
            $this->createPersonalTeam($newUser);
        }

        return redirect()->intended('/search');
    }

    protected function createPersonalTeam($user)
    {
        $team = new Team();
        $team->user_id = $user->id;
        $team->name = $user->name . "'s Team"; // You can customize the team name
        $team->personal_team = true;
        $team->save();

        $user->current_team_id = $team->id;
        $user->save();
    }
}

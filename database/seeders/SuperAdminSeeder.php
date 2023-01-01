<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $admin_name = env('ADMIN_EMAIL', null);
        $admin_pass = env('ADMIN_PASS', null);
        if (empty($admin_pass) || empty($admin_name)){
            return;
        }
        tap(User::create([
            'name' => $admin_name,
            'email' => $admin_name,
            'password' => Hash::make($admin_pass),
        ]), function (User $user) {
            $this->createTeam($user);
        });

        try {
            $user = User::where('email', $admin_name)->first();
            if (!$user instanceof User) return;

            $role = Role::findOrCreate('super-user');
            $user->assignRole($role);
            $user->save();
        }catch (\Exception $e){
            return;
        }

    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}

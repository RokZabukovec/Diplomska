<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Command;
use Illuminate\Support\Facades\Hash;
use Spatie\Tags\Tag;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Hash the password
        $password = Hash::make('password123'); // Replace 'password123' with the actual password

        // Find or create the user
        $user = User::firstOrCreate(['email' => 'example@example.com'], [
            'name' => 'John Doe',
            'password' => $password,
        ]);

        // Create projects and commands for the user
        $projects = Project::factory(5)->create(['user_id' => $user->id]);
        $projects->each(function ($project) {
            $project->commands()->saveMany(
                Command::factory(3)->create()
            );
        });

        // Attach tags to commands
        Command::all()->each(function ($command) {
            $command->attachTags(Tag::inRandomOrder()->take(rand(1, 3))->get());
        });
    }
}

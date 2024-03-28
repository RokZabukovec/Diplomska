<?php

namespace Database\Factories;

use App\Models\Command;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Tags\Tag;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Command>
 */
class CommandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'command' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'project_id' => Project::factory()->create()->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Command $command) {
            // Associate random tags with the command
            $tags = Tag::inRandomOrder()->take(rand(1, 3))->get();
            $command->attachTags($tags);
        });
    }
}

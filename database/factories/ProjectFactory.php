<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'user_id' => 2,
            'description' => $this->faker->paragraph,
            'label_color' => $this->faker->hexColor
        ];
    }
}

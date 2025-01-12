<?php

namespace Database\Factories;

use App\Models\User; // Adicione esta linha
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=> collect(fake()->words(5))->join(' '),
            'description' => htmlspecialchars(fake()->randomHtml()),
            'ends_at' => fake()->dateTimeBetween('now', '+3 days'),
            'status' => fake()->randomElement(['open', 'closed']),
            'tech_stack' => fake()->randomElements(['NextJS', 'React', 'Javascript', 'NodeJS', 'Vite'], random_int(1, 5)),
            'created_by' => User::factory(),
        ];
    }
}

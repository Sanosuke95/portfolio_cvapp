<?php

namespace Database\Factories;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'level' => random_int(1, 5),
            'user_id' => User::where('email', 'laravel@dev.com')->first(),
            'resume_id' => Resume::select('id')->inRandomOrder()->first(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Resume;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_date = fake()->dateTimeBetween('-10 years', 'now');
        return [
            'user_id' => User::where('email', 'laravel@dev.com')->first(),
            'resume_id' => Resume::select('id')->inRandomOrder()->first(),
            'name' => fake()->name(),
            'location' => fake()->text(random_int(20, 30)),
            'start_date' => $start_date,
            'end_date' => date_add($start_date, date_interval_create_from_date_string("10 days")),
            'description' => fake()->text()
        ];
    }
}

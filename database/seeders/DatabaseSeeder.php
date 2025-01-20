<?php

namespace Database\Seeders;

use App\Models\Formation;
use App\Models\Resume;
use App\Models\Skill;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'email' => 'laravel@dev.com',
            'password' => 'laravel'
        ]);
        Resume::factory()->count(random_int(1, 5))->create();
        Skill::factory()->count(random_int(10, 20))->create();
        Formation::factory()->count(random_int(10, 15))->create();
    }
}

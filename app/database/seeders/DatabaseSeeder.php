<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         User::factory(10)->create();
         Project::factory(10)->create();
         Task::factory(10)->create();

        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => 'testtest@test.com',
            'username' => 'testtest',
            'password' => Hash::make('password'),
        ]);
    }
}

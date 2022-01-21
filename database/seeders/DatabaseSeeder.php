<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(10)->create();

        foreach ($users as $user) {
            $post = Profile::factory()
                ->count(1)
                ->for($user)
                ->create();
        }

    }
}

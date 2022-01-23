<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(10)->create();

        foreach ($users as $user) {
            Profile::factory()
            ->count(1)
            ->for($user)
            ->create();
        }

        $developerUser = new User();
        $developerUser->username = 'rizaldy.wirawan';
        $developerUser->password = Hash::make('secret');
        $developerUser->remember_token = Str::random(10);
        $developerUser->login_code = '082246205201';
        $developerUser->save();

        $developerProfile = new Profile();
        $developerProfile->name = "Rizaldy Wirawan";
        $developerProfile->email = "rizaldy.wirawan@gmail.com";
        $developerUser->profile()->save($developerProfile);
    }
}

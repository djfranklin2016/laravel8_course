<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $usersCount = max((int)$this->command->ask('How many users would you like?', 20), 1);
        // factory(App\Models\User::class)->states('john-doe')->create();
        // factory(App\Models\User::class, $usersCount)->create();
        // $usersCount = max((int)$this->command->ask('How many users would you like?', 20), 1);
        // $user = User::factory()->states('john-doe')->create();
        
        // $user = User::factory()->count($usersCount)->create();

        $user = User::factory()->count(10)->create;
    }
}

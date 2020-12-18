<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Database\Factories;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        // DB::table('users')->insert([
        //     'name' => 'John Doe',
        //     'email' => 'johndoe@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);

        // \App\Models\User::factory()->state('johndoe')->create();

        $users = \App\Models\User::factory(20)->create();

        // dd($users->count());

        $posts = \App\Models\BlogPost::factory(20)->create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();
        $user = new \App\Models\User();
        $user->username = "admin";
        $user->email = "admin@admin.com";
        $user->password = Hash::make("12345678");
        $user->is_admin = true;
        $user->save();
        $this->call([
            CategorySeeder::class
        ]);
    }
}

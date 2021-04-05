<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\Roles;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // create users to roles
        $user = User::create([
            "name" => "readUsers",
            "email" => "read@test-poc.com",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        Roles::create([
            "user_id" => $user['id'],
            "role" => "read",
        ]);

        $user = User::create([
            "name" => "readAddUsers",
            "email" => "read.add@test-poc.com",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        Roles::create([
            "user_id" => $user['id'],
            "role" => "read",
        ]);

        Roles::create([
            "user_id" => $user['id'],
            "role" => "add",
        ]);

        $user = User::create([
            "name" => "AllUsers",
            "email" => "all@test-poc.com",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        Roles::create([
            "user_id" => $user['id'],
            "role" => "read",
        ]);

        Roles::create([
            "user_id" => $user['id'],
            "role" => "add",
        ]);

        Roles::create([
            "user_id" => $user['id'],
            "role" => "delete",
        ]);

        \App\Models\Contacts::factory(10)->create();
    }
}

<?php

namespace Database\Seeders;

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
        // create users to roles
        \App\Models\User::create([
            "name" => "readUsers",
            "email" => "read@test-poc.com",
            "role" => "read",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        \App\Models\User::create([
            "name" => "readAddUsers",
            "email" => "read.add@test-poc.com",
            "role" => "read-add",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        \App\Models\User::create([
            "name" => "AllUsers",
            "email" => "all@test-poc.com",
            "role" => "read-add-delete",
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        \App\Models\Contacts::factory(10)->create();
    }
}

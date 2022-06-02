<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'organikjadirp@gmail.com',
            'password' => Hash::make('organikjadirp'),
            'role' => 'admin',
            'status' => 'yes',
        ]);
    }
}

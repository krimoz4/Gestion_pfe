<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    if (!\App\Models\User::where('email', 'admin@emsi.ma')->exists()) {

        $user = \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'admin@emsi.ma',
            'password' => bcrypt('123456'),
            'role' => 'admin'
        ]);

        \App\Models\Administrateur::create(['user_id' => $user->id]);
    }
}
}

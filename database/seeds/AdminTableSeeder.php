<?php

use App\User;
use App\UserDetails;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user =  User::create([
            'name' => 'Ultimate',
            'email' => 'ultimate@admin',
            'role_id' => 0,
            'email_verified_at' => now(),
            'password' => Hash::make('password')
        ]);
        UserDetails::create([
            'user_id' => $user->id,
        ]);
    }
}

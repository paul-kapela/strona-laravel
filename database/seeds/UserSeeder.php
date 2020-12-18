<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'mysio17',
            'email' => 'mysio175@gmail.com',
            'password' => Hash::make('bobibobi123@'),
            'email_verified_at' => '2020-08-19 17:43:46',
        ]);

        \App\User::find(1)->roles()->attach(\App\Role::where('name', '=', 'admin')->get());
    }
}

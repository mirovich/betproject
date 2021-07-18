<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'administrator',
            'username' => 'administrator',
            'role' => 10,
            'login' => '',
            'login2' => '',
            'manager_id' => 1,
            'email' => 'administrator@cryptocube.ru',
            'password' => bcrypt('qwerty123456'),
//            'ticketit_admin' => 1,
//            'ticketit_agent' => 1,
            'avatar' => '/img/avatar.png',
            'money' => 104219,
            'is_yt' => 0,
            'profit' => 5679,
            'opened' => 116,
            'ref_link' => 'none',
            'deposit' => 100,
            'bonus_money' => 0
        ]);
    }
}

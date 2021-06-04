<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Psy\Util\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = [];
        $adminLogin = 'admin';
        $adminPassword = '16et548e43';

        $adminUser[] = [
            'role_id' => 1,
            'firstname' => 'Ívan',
            'surname' => 'Ivanov',
            'login' => $adminLogin,
            'email' => '',
            'password' => $adminPassword,
            'remember_token' => \Illuminate\Support\Str::random(60),
        ];

        DB::table('users')->insert($adminUser);
    }
}

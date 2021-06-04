<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userRoles = [];

        $roleName = 'Admin';
        $userRoles[] = [

            'name' => $roleName,
            'parent_id' => 0,
        ];
        $roles = [
            1 => 'Главный программист',
            2 => 'Программист',
            3 => 'Главный менеджер',
            4 => 'Менеджер',
            5 => 'Главный бухгалтер',
            6 => 'Бухгалтер',
        ];

        for ($i = 1;$i<=6; $i++) {
            $roleName = $roles[$i];
            if ($i%2 == 0) {
                $parentId = $i ;
            } else {
                $parentId = 1;
            }

            $userRoles[] = [
                'name' => $roleName,
                'parent_id' => $parentId,
            ];

        }

        DB::table('roles')->insert($userRoles);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [];

        $categoryNames = [
            1   =>  'Технические пароли',
            2   =>  'Банковские пароли',
            3   =>  'Пароли от соцсетей',
        ];

        for ($i=1; $i <= 3; $i++) {
            $categoryName = $categoryNames[$i];

            $categories[] = [
                'name'      =>  $categoryName,
                'parent_id' =>  0,
            ];
        }


        DB::table('categories')->insert($categories);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                [
                    'id' => 1,
                    'product_type' => 'Снаряжение',
                ],
                [
                    'id' => 2,
                    'product_type' => 'Экипировка',
                ],
                [
                    'id' => 3,
                    'product_type' => 'Дополнительно',
                ],
            ]
        );
    }
}

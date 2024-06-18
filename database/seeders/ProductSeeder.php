<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(
          [
              [
                  'title' => 'Карабин Ares M4 Sharps',
                  'price' => 100,
                  'img' => 'Ares.jpg',
                  'product_type' => 1,
                  'qty' => 100,
                  'created_at' => date('2023-02-19')
              ],
              [
                  'title' => 'Пистолет-пулемёт Arcturus PPK20 CQB ME (AT-PPK20-ME)',
                  'price' => 100,
                  'img' => 'Arcturus.jpg',
                  'product_type' => 1,
                  'qty' => 100,
                  'created_at' => date('2023-02-19')
              ],
              [
                  'title' => 'Дробовик Cyma SGR-12 Platinum AEG BK (CM102)',
                  'price' => 100,
                  'img' => 'Cyma.jpg',
                  'product_type' => 1,
                  'qty' => 100,
                  'created_at' => date('2023-02-19')
              ],
              [
                  'title' => 'Нагрудник WoSport Tactical Chest Rig OD (VE-74-RG)',
                  'price' => 100,
                  'img' => 'WoSport.jpg',
                  'product_type' => 2,
                  'qty' => 100,
                  'created_at' => date('2023-02-19')
              ],
              [
                  'title' => 'Патч ШВЕЙНЫЙ КОТ Красная Армия',
                  'price' => 100,
                  'img' => 'Patch.jpg',
                  'product_type' => 3,
                  'qty' => 100,
                  'created_at' => date('2023-02-19')
              ],
          ]
        );
    }
}

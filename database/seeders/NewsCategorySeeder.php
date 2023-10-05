<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
          'Politics','Business','Corporate','Health',
            'Education','Science','Foods','Entertainment',
            'Travel','Lifestyle','Politics'
        ];

        foreach ($category as $value){
            DB::table('news_categories')->insert([
                'name' => $value,
                'created_by' => 1
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
          'Trending','Latest','Featured','Breaking'
        ];

        foreach ($types as $value){
            DB::table('news_types')->insert([
                'name' => $value,
                'created_by' => 1
            ]);
        }
    }
}

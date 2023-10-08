<?php

namespace Database\Seeders;

use App\Helper\NewsHelper;
use App\Models\News;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        $news = NewsHelper::getNews();
        foreach ($news as $value){
            DB::table('news')->insert([
                'category_id' => $value['category_id'],
                'date' => $value['date'],
                'title'=>$value['title'],
                'type'=>$value['type'],
                'description'=>$value['description'],
                'short_description'=>$value['short_description'],
                'writer_id'=>$value['writer_id'],
                'image'=>$value['image'],
                'status'=>$value['status'],
                'created_by'=>$value['created_by'],
            ]);
        }
    }
}

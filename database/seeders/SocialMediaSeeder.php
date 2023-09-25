<?php

namespace Database\Seeders;


use App\Helper\SocialMedia;
use App\Models\SocialLink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $social_links = SocialMedia::getName();
        foreach ($social_links as $value){
            SocialLink::create([
                'name' => $value['name'],
                'created_by' => '1',
            ]);
        }

    }
}

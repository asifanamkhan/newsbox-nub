<?php

namespace Database\Seeders;


use App\Helper\SocialMedia;
use App\Models\SocialLink;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('social_links')->insert([
            'name' => 'Facebook',
            'icon' => 'fa fa-facebook',
            'color' => '#39569E',
            'created_by' => '1',
        ]);
        DB::table('social_links')->insert([
            'name' => 'Youtube',
            'icon' => 'fa fa-youtube',
            'color' => '#DC472E',
            'created_by' => '1',
        ]);
        DB::table('social_links')->insert([
            'name' => 'Twitter',
            'icon' => 'fa fa-twitter',
            'color' => '#52AAF4',
            'created_by' => '1',
        ]);
        DB::table('social_links')->insert([
            'name' => 'Instagram',
            'icon' => 'fa fa-instagram',
            'color' => '#C8359D',
            'created_by' => '1',
        ]);
        DB::table('social_links')->insert([
            'name' => 'LinkedIn',
            'icon' => 'fa fa-linkedin',
            'color' => '#0185AE',
            'created_by' => '1',
        ]);
    }
}

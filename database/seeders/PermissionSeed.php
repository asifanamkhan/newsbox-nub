<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => 'settings',
                'guard_name' => 'web',
            ],
            [
                'id' => 2,
                'name' => 'slide',
                'guard_name' => 'web',
            ],
            [
                'id' => 3,
                'name' => 'news',
                'guard_name' => 'web',
            ],
            [
                'id' => 4,
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'id' => 5,
                'name' => 'user',
                'guard_name' => 'web',
            ],
            [
                'id' => 6,
                'name' => 'gallery',
                'guard_name' => 'web',
            ],
            [
                'id' => 7,
                'name' => 'ads',
                'guard_name' => 'web',
            ],
            [
                'id' => 8,
                'name' => 'events',
                'guard_name' => 'web',
            ],
            [
                'id' => 9,
                'name' => 'achievements',
                'guard_name' => 'web',
            ],
        ]);
    }
}

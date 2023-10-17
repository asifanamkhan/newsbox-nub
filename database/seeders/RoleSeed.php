<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'id' => 1,
                'name' => 'super admin',
                'guard_name' => 'web',
            ],
            [
                'id' => 2,
                'name' => 'admin',
                'guard_name' => 'web',
            ],
            [
                'id' => 3,
                'name' => 'readers',
                'guard_name' => 'web',
            ],
            [
                'id' => 4,
                'name' => 'news writer',
                'guard_name' => 'web',
            ],

        ]);
    }
}

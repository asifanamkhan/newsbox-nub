<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(SocialMediaSeeder::class);
        $this->call(NewsTypeSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(NewsCategorySeeder::class);
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(RoleHasPermissionSeed::class);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('groups')->insert([
            ['name' => 'Bugifx', 'description' => 'Used for work fixing product bugs', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Feature', 'description' => 'Used for work on new features.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Hotfix', 'description' => 'Used for fixing urgent bugs on production that have high impact.', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Release', 'description' => 'Used for preparing and testing your work for release.', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

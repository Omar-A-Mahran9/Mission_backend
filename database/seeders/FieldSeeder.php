<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fields = [
            ['name_en' => 'Engineering', 'name_ar' => 'الهندسة'],
            ['name_en' => 'Medicine',    'name_ar' => 'الطب'],
            ['name_en' => 'Business',    'name_ar' => 'الأعمال'],
            ['name_en' => 'Art',         'name_ar' => 'الفنون'],
            ['name_en' => 'Law',         'name_ar' => 'القانون'],
        ];

        DB::table('fields')->insert($fields);
    }
}

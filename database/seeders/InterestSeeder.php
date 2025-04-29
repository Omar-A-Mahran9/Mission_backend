<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $interests = [
            ['name_en' => 'Technology', 'name_ar' => 'التكنولوجيا'],
            ['name_en' => 'Travel',     'name_ar' => 'السفر'],
            ['name_en' => 'Music',      'name_ar' => 'الموسيقى'],
            ['name_en' => 'Sports',     'name_ar' => 'الرياضة'],
            ['name_en' => 'Reading',    'name_ar' => 'القراءة'],
        ];
        
        DB::table('interests')->insert($interests);
    }
}
